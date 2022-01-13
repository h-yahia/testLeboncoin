<?php

namespace App\Service;

use App\Repository\AdRepository;

class AdService {

    private $adRepository;

    public function __construct(AdRepository $adRepository) {
        $this->adRepository = $adRepository;
    }


    public function getAd($id): array {
        $ad = $this->adRepository->find($id);
        if(!$ad)
            throw new \Exception('no add found with this id : '.$id);
        return $ad->serialize();
    }
}