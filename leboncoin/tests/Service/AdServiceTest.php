<?php

namespace App\Tests\Service;

use App\Service\AdService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AdServiceTest extends KernelTestCase
{
    public function testFindModelRs4()
    {
        self::bootKernel();
        $container = static::getContainer();
        $adService = $container->get(AdService::class);
        $model = $adService->findModel('rs4 avant');
        $this->assertEquals('audi', $model->getBrand());
    }

    public function testFindModelSerie5()
    {
        self::bootKernel();
        $container = static::getContainer();
        $adService = $container->get(AdService::class);
        $model = $adService->findModel('gran turismo serie5');
        $this->assertEquals('bmw', $model->getBrand());
    }

    public function testFindModelDs3()
    {
        self::bootKernel();
        $container = static::getContainer();
        $adService = $container->get(AdService::class);
        $model = $adService->findModel('ds 3 crossback');
        $this->assertEquals('citroen', $model->getBrand());
        $model = $adService->findModel('CrossBack ds 3');
        $this->assertEquals('citroen', $model->getBrand());
    }
}