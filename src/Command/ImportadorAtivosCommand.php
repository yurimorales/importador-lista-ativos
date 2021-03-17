<?php 

namespace App\Command;

use App\Entity\Categorias;
use App\Entity\Ativos;
use App\Entity\TipoUso;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\ProgressBar;

class ImportadorAtivosCommand extends Command
{

    protected static $defaultName = 'app:importador-ativos';
    private $projectDir;
    private $entityManager;

    public function __construct($projectDir, EntityManagerInterface $entityManager)
    {
        $this->projectDir = $projectDir;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Importador de lista de ativos da PHARMA')
            ->addArgument('filename', InputArgument::REQUIRED, 'The path file csv to import in the database.')
            ->setHelp('This command allows import ativos from PHARMA from csv file informed...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);

        $filename = $input->getArgument('filename');

        if (!file_exists($this->projectDir . '/public/' . $filename)) {
            $io->error('Not found filename informed.');
            return Command::FAILURE;
        }

        $io->info('Starting import, please wait...');

        // Coverte o csv em array php
        $rows = $this->getCsvRowsAsArray($filename);
        
        // tutorial progressBar: https://jonczyk.me/2017/09/20/make-cool-progressbar-symfony-command/
        $progressBar = new ProgressBar($output, count($rows));
        $progressBar->setFormat(
            "%current%/%max% [%bar%] %percent:3s%%\n🏁  %estimated:-21s% %memory:21s%\n"
        );
        $progressBar->setBarCharacter('<fg=green>⚬</>');
        $progressBar->setEmptyBarCharacter("<fg=red>⚬</>");
        $progressBar->setProgressCharacter("<fg=green>➤</>");

        $progressBar->setRedrawFrequency(10);
        $progressBar->start();

        $tipoUsoEntity = $this->entityManager->getRepository(TipoUso::class);
        $ativoEntity = $this->entityManager->getRepository(Ativos::class);
        
        $existingCount = 0;
        $newCount = 0;

        foreach ($rows as $row) {

            // remove espaços no inicio e final, de todos os valores do array
            $row = array_map(function($value){
                return trim($value);
            }, $row);
            
            // busca tipo de uso
            $tipoUso = !empty($row["TIPO DE USO"]) ? $tipoUsoEntity->findOneBy(['nome' => $row["TIPO DE USO"]]) : null;
            
            // atualiza registro se existir no db
            if ($existeAtivo = $ativoEntity->findOneBy(['nome' => $row['NOME']])) {
                
                $this->updateAtivo($existeAtivo, $tipoUso, $row);
                $existingCount++;

            } else {

                // cria registro
                $this->createNewAtivo($tipoUso, $row);
                $newCount++;

            }
            
            $progressBar->advance();
            usleep(5000);

        }
        
        $this->entityManager->flush();

        $progressBar->finish();

        $io->newLine();
        $io->success("CSV File has been successfully imported. Existing items have been updated: $existingCount. Items have been added: $newCount");

        return Command::SUCCESS;

    }

    private function createNewAtivo($tipoUso, $item)
    {
        
        $categoria = $this->createCategory($item['CATEGORIA']);

        $entity = new Ativos();
        $entity->setNome($item["NOME"])
            ->setAno(!empty($item["ANO"]) ? $item["ANO"] : 2020)
            ->setDescricaoDestaque($item["DESCRIÇÃO DESTAQUE"])
            ->setDescricao($item["DESCRIÇÃO"])
            ->setSugestaoPosologica($item["SUGESTÃO POSOLÓGICA"])
            ->setLinkArtigo($item["LINK ARTIGO"])
            ->setFkTipoUsoId($tipoUso)
            ->setFkCategoriasId($categoria);

        $this->entityManager->persist($entity);

    }

    private function updateAtivo($entity, $tipoUso, $item)
    {

        $categoria = $this->createCategory($item['CATEGORIA']);

        $entity->setNome($item["NOME"])
            ->setAno(!empty($item["ANO"]) ? $item["ANO"] : 2020)
            ->setDescricaoDestaque($item["DESCRIÇÃO DESTAQUE"])
            ->setDescricao($item["DESCRIÇÃO"])
            ->setSugestaoPosologica($item["SUGESTÃO POSOLÓGICA"])
            ->setLinkArtigo($item["LINK ARTIGO"])
            ->setFkTipoUsoId($tipoUso)
            ->setFkCategoriasId($categoria);

        $this->entityManager->persist($entity);
    }

    private function createCategory($categoriaNome)
    {

        if (empty($categoriaNome)) return null;
        
        // busca categoria
        $entity = $this->entityManager->getRepository(Categorias::class)->findOneBy([
            'nome' => $categoriaNome
        ]);

        // Se não existir, entao cria
        if (!$entity) {

            $categoria = new Categorias();
            $categoria->setNome($categoriaNome);

            $this->entityManager->persist($categoria);
            $this->entityManager->flush();

            return $categoria;
        }

        return $entity;

    }

    private function getCsvRowsAsArray($filename)
    {

        $inputFile = $this->projectDir . '/public/' . $filename;

        $decoder = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);       

        return $decoder->decode(file_get_contents($inputFile), 'csv');  

    }

}