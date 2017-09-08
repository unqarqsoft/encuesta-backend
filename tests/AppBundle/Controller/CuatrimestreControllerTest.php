<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

class CuatrimestreControllerTest extends WebTestCase
{
    public function testPostMateria()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/materias', [], [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"nombre": "Intro", "nucleo": "Basico"}'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('"nombre":"Intro"', $client->getResponse()->getContent());
        $this->assertContains('"nucleo":"Basico"', $client->getResponse()->getContent());
    }
}
