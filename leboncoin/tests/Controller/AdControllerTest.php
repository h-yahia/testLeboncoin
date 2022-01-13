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
        $crawler = $client->request('GET', '/api/ad/A');

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

    public function testSuccessPutAd(): void
    {
        $title = 'title test 1';
        $client = static::createClient();
        $client->request(
            'PUT',
            '/api/ad/1',
            array(
                'title' => $title,
            )
        );
        $this->assertResponseIsSuccessful();

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals($title, $data['title']);
    }

    public function testSuccessDeleteAd(): void
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/api/ad/1'
        );
        $this->assertResponseIsSuccessful();
    }

}
