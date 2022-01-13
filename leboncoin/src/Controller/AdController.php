<?php

namespace App\Controller;

use App\Service\AdService;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{

    public function getAd($id, AdService $adService): JsonResponse {
        try {
            return new JsonResponse($adService->getAd($id));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'errors' => $e->getMessage(),
                'status' => 404
            ), 404);
        }
    }

    public function postAd(Request $request, AdService $adService): JsonResponse {
        try {
            $data = $request->request->all();
            return new JsonResponse($adService->postAd($data));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'errors' => $e->getMessage(),
                'status' => 400
            ), 400);
        }
    }

    public function putAd($id, Request $request, AdService $adService): JsonResponse {
        try {
            $data = $request->request->all();
            return new JsonResponse($adService->putAd($id, $data));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'errors' => $e->getMessage(),
                'status' => 400
            ), 400);
        }
    }

    public function deleteAd($id, AdService $adService): JsonResponse {
        try {
            return new JsonResponse($adService->deleteAd($id));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'errors' => $e->getMessage(),
                'status' => 400
            ), 400);
        }
    }
}
