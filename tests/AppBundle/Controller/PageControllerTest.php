<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("каталог")')->count()
        );
    }

    // Testing about page
    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("О сайте")')->count()
        );
    }

    // Testing feedback page
    public function testFeedback()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/feedback');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Обратная связь")')->count()
        );

        // Test form
        $form = $crawler->selectButton('form[send]')->form();
        $crawler = $client->submit($form, [
            'form[name]' => 'Nick',
            'form[email]' => 'test@test.ru',
            'form[message]' => 'Test message',
        ]);

        // After sending site must show sender's name in page
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Nick")')->count()
        );
    }
}
