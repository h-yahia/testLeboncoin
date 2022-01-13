<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $job = new Job();
            $job->setTitle('job '.$i);
            $job->setContent('content '.$i);
            $manager->persist($job);
        }

        $manager->flush();
    }
}
