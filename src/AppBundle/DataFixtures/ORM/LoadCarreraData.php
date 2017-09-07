<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Carrera;

class LoadCarreraData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $carrera = new Carrera();
        $carrera->setNombre('TPI');
        $manager->persist($carrera);

        $carrera = new Carrera();
        $carrera->setNombre('LDS');
        $manager->persist($carrera);

        $manager->flush();
    }
}
