<?php

namespace App\Service;

use App\Entity\Automobile;
use App\Repository\AdRepository;
use App\Repository\ModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class AdService {

    private $adRepository;
    private $modelRepository;
    private $formFactory;
    private $em;

    public function __construct(AdRepository $adRepository, ModelRepository $modelRepository, FormFactoryInterface $formFactory, EntityManagerInterface $em) {
        $this->adRepository = $adRepository;
        $this->modelRepository = $modelRepository;
        $this->formFactory = $formFactory;
        $this->em = $em;
    }


    public function getAd($id): array {
        $ad = $this->adRepository->find($id);
        if(!$ad)
            throw new \Exception('no ad found with this id : '.$id);
        return $ad->serialize();
    }

    public function postAd($data): array {
        if(!isset($data['category']))
            throw new \Exception('Please choose a category');
        $category = $data['category'];
        unset($data['category']);
        $categoryClassName = 'App\Entity\\'.ucfirst($category);
        $categoryFormClassName = 'App\Form\\'.ucfirst($category)."Type";
        if(!class_exists($categoryClassName) || !class_exists($categoryFormClassName))
            throw new \Exception();
            $ad = new $categoryClassName();
        if($ad instanceof Automobile) {
            if($model = $this->findModel($data['model'])) {
                $data['model'] = $model->getName();
                $data['brand'] = $model->getBrand();
            } else
                throw new \Exception();
        }
        $form = $this->formFactory->create($categoryFormClassName, $ad);
        $form->submit($data);
        if ($form->isValid()) {
            $this->em->persist($ad);
            $this->em->flush();
            return $ad->serialize();
        } else {
            throw new \Exception('No valid');
        }
    }

    public function putAd($id, $data): array {
        $ad = $this->adRepository->find($id);
        if(!$ad)
            throw new \Exception('no ad found with this id : '.$id);
        $categoryClassName = 'App\Entity\\'.ucfirst($ad->getCategory());
        $categoryFormClassName = 'App\Form\\'.ucfirst($ad->getCategory())."Type";
        if(!class_exists($categoryClassName) || !class_exists($categoryFormClassName))
            throw new \Exception();
        $form = $this->formFactory->create($categoryFormClassName, $ad);
        $form->submit($data, false);
        if ($form->isValid()) {
            $this->em->persist($ad);
            $this->em->flush();
            return $ad->serialize();
        } else {
            throw new \Exception('No valid');
        }
    }

    public function deleteAd($id): array {
        $ad = $this->adRepository->find($id);
        if(!$ad)
            throw new \Exception('no ad found with this id : '.$id);
        $this->em->remove($ad);
        $this->em->flush();
        return array('message' => 'Ad was deleted.');
    }

    public function findModel($modelName) {
        $modelsFind = array();
        $res = null;
        $models = $this->modelRepository->findAll();
        //Clean model name
        $modelName = $this->cleanModelName($modelName);

        //Find the right model
        foreach($models as $model) {
            if(stripos($modelName, $model->getName()) !== false)
                $modelsFind[] = $model;
        }
        //If find 0 or more than 1
        if(count($modelsFind) !== 1) {
            if(!empty($modelsFind))
                $models = $modelsFind;
            $minDistance = 0;
            foreach($models as $model) {
                similar_text($modelName, $model->getName(), $distance);
                if($distance > $minDistance) {
                    $minDistance = $distance;
                    $res = $model;
                }
            }
            if($minDistance)
                return $res;
        } else
            return $modelsFind[0];
            return false;
    }

    private function cleanModelName($modelName) {
        $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u, ");
        $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,");
        return str_replace($search, $replace, $modelName);
    }
}