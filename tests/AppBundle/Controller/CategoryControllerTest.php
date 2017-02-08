<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{


    public function testShowCategory()
    {
        $client = static::createClient();

        $client->request('GET', '/category/');

        // Assert that the response is a redirect to /
        $this->assertTrue(
            $client->getResponse()->isRedirect('/'),
            'response is a redirect to /'
        );
    }

}
