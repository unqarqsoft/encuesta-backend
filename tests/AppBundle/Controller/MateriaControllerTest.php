<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

class MateriaControllerTest extends WebTestCase
{
    public function testPostMateria()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/cuatrimestres', [], [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"descripcion": "cuatri1", "anio": "2017", "periodo": "2"}'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('"descripcion":"cuatri1"', $client->getResponse()->getContent());
        $this->assertContains('"anio":"2017"', $client->getResponse()->getContent());
        $this->assertContains('"periodo":2', $client->getResponse()->getContent());
    }
}
