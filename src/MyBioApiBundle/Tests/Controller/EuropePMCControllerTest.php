<?php

namespace MyBioApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EuropePMCControllerTest extends WebTestCase
{
    public function testQuery()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'query');
    }

}
