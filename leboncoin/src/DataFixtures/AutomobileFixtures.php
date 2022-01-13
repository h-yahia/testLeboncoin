<?php

namespace App\DataFixtures;

use App\Entity\Automobile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AutomobileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $automobile = new Automobile();
            $automobile->setTitle('job '.$i);
            $automobile->setContent('content '.$i);
            $automobile->setBrand('brand '.$i);
            $automobile->setModel('model '.$i);
            $manager->persist($automobile);
        }

        $manager->flush();
    }
}
