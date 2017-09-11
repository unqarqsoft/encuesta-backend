<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Alumno;

class AlumnoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $alumno = new Alumno();
        $alumno->setNombre('Hernan');
        $alumno->setApellido('Slavich');
        $alumno->setEmail('hernan.slavich@gmail.com');

        $manager->persist($alumno);
        $manager->flush();
    }
}
