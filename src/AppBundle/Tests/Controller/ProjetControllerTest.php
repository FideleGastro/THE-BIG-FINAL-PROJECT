<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetControllerTest extends WebTestCase
{
    public function testSelect()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/select');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
    }

}
