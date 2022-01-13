<?php

namespace App\DataFixtures;

use App\Entity\RealEstate;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RealEstateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $realEstate = new RealEstate();
            $realEstate->setTitle('realEstate '.$i);
            $realEstate->setContent('content '.$i);
            $manager->persist($realEstate);
        }

        $manager->flush();
    }
}
