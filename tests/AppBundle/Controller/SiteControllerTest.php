<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SiteControllerTest extends WebTestCase
{


    public function testAddSite()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Добавление сайта")')->count()
        );

        // Test form
        $form = $crawler->selectButton('form[add]')->form();
        $crawler = $client->submit($form, [
            'form[title]' => 'Test site',
            'form[email]' => 'test@test.ru',
            'form[url]' => $this->generateRandomUrl(),
            'form[category]' => 0,
            'form[shortDescription]' => 'Test short description',
            'form[description]' => 'Test description',
            'form[keywords]' => 'key, words',
        ]);

        // After sending site must show site's info
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Test short description")')->count()
        );
    }

    /*
     * Generating random url
     * @param Integer $length - length of subdomain
     * @return String like a 'sadjshdjahsd.ru'
     */
    private function generateRandomUrl($length = 14){
        $chars = 'abdefhgdsgrergllkjtrjhgguerbgrehgiurehgiknrstyz';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string . '.ru';
    }
}
