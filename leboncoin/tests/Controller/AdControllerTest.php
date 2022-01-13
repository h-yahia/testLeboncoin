<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdControllerTest extends WebTestCase
{
    public function testSuccessGetAd(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/ad/1');

        $this->assertResponseIsSuccessful();
    }

    public function testErrorGetAd(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/ad/100');

        $this->assertSame(404, $client->getResponse()->getStatusCode());
    }


}
