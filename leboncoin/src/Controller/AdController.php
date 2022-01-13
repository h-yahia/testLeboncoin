<?php

namespace App\Controller;

use App\Service\AdService;
use App\Repository\AdRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{

    public function getAd($id, AdService $adService): JsonResponse {
        try {
            return new JsonResponse($adService->getAd($id));
        } catch (\Excetion $e) {
            return new JsonResponse(array(
                'errors' => $e->getMessage(),
                'status' => 404
            ), 404);
        }
    }
}
