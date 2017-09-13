<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Carrera;

class CarreraFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $carrera = new Carrera();
        $carrera->setNombre('Tecnicatura Universitaria en Programación Informática');
        $this->addReference('carrera-tpi', $carrera);
        $manager->persist($carrera);

        $carrera = new Carrera();
        $carrera->setNombre('Licenciatura en Informática');
        $this->addReference('carrera-lds', $carrera);
        $manager->persist($carrera);

        $manager->flush();
    }
}
