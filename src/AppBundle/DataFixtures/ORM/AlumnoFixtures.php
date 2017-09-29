<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Alumno;

class AlumnoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $generator = new \Nubs\RandomNameGenerator\Alliteration();

        for ($i=1; $i <= 100; $i++) {
            list($nombre, $apellido) = explode(' ', $generator->getName());
            $alumno = new Alumno();
            $alumno->setNombre($nombre);
            $alumno->setApellido($apellido);
            $alumno->setEmail(strtolower("$nombre.$apellido$i@email.com"));

            $this->addReference("alumno$i", $alumno);
            $manager->persist($alumno);
        }

        $manager->flush();
    }
}
