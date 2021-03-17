<?php

namespace App\DataFixtures;

use App\Entity\TipoUso;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TipoUsoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $types = [
            'Insumo de uso interno',
            'Insumo de uso externo'
        ];

        $entity = $manager->getRepository(TipoUso::class);

        foreach ($types as $type) {

            $checkExists = $entity->findOneBy([
                'nome' => $type
            ]);

            if (!$checkExists) {

                $typeUsage = (new TipoUso())
                    ->setNome($type);

                $manager->persist($typeUsage);

            }

        }

        $manager->flush();

    }
}
