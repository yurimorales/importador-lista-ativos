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

        foreach ($types as $type) {

            $checkExists = $manager->getRepository(TipoUso::class)->findOneBy([
                'nome' => $type
            ]);

            if ($checkExists == null) {

                $typeUsage = (new TipoUso())
                    ->setNome($type);

                $manager->persist($typeUsage);

            }

        }

        $manager->flush();

    }
}
