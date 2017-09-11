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
        $carrera->setNombre('TPI');
        $this->addReference('carrera-tpi', $carrera);
        $manager->persist($carrera);

        $carrera = new Carrera();
        $carrera->setNombre('LDS');
        $this->addReference('carrera-lds', $carrera);
        $manager->persist($carrera);

        $manager->flush();
    }
}
