<?php

namespace App\DataFixtures;

use App\Entity\Model;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cars = array(
            'audi' => array(
                'Cabriolet', 'Q2', 'Q3', 'Q5', 'Q7', 'Q8', 'R8', 'Rs3', 'Rs4', 'Rs5', 'Rs7', 'S3', 'S4', 'S4 Avant',
                'S4 Cabriolet', 'S5', 'S7', 'S8', 'SQ5', 'SQ7', 'Tt', 'Tts', 'V8'
            ),
            'bmw' => array(
                'M3', 'M4', 'M5', 'M535', 'M6', 'M635', 'Serie 1', 'Serie 2', 'Serie 3', 'Serie 4', 'serie 5',
'Serie 6', 'Serie 7', 'Serie 8'
            ),
            'citroen' => array('C1', 'C15', 'C2', 'C25', 'C25D', 'C25E', 'C25TD', 'C3', 'C3 Aircross', 'C3 Picasso', 'C4',
            'C4 Picasso', 'C5', 'C6', 'C8', 'Ds3', 'Ds4', 'Ds5')
        );

        foreach($cars as $brand => $models) {
            foreach($models as $modelName) {
                $model = new Model();
                $model->setName($modelName);
                $model->setBrand($brand);
                $manager->persist($model);
            }
        }

        $manager->flush();
    }
}
