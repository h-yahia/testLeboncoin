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

    public function testSuccessPostAd(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/ad',
            array(
                'title' => 'title test',
                'content' => 'content test',
                'category' => 'job'
            )
        );
        $this->assertResponseIsSuccessful();
    }

    public function testErrorPostAd(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/ad',
            array( // Without content, form not valid
                'title' => 'title test',
                'category' => 'job'
            )
        );
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }

    public function testSuccessPostAutomobileAd(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/ad',
            array(
                'title' => 'title test',
                'content' => 'content test',
                'brand' => 'brand test',
                'model' => 'model test',
                'category' => 'automobile'
            )
        );
        $this->assertResponseIsSuccessful();
    }

    public function testErrorPostAutomobileAd(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/ad',
            array( // Without content, form not valid
                'title' => 'title test',
                'content' => 'content test',
                'brand' => 'brand test',
                'category' => 'automobile'
            )
        );
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }


}
