<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article/get');
    }

    public function testPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article/post');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article/deleteAction');
    }

}
