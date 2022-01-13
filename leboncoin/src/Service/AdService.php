<?php

namespace App\Service;

use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class AdService {

    private $adRepository;
    private $formFactory;
    private $em;

    public function __construct(AdRepository $adRepository, FormFactoryInterface $formFactory, EntityManagerInterface $em) {
        $this->adRepository = $adRepository;
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
}