<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Materia;

class MateriaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getMaterias() as $key => $mat) {
            $materia = new Materia();
            $materia->setNombre($mat['nombre']);
            $materia->setNucleo($mat['nucleo']);

            $this->addReference("materia$key", $materia);
            $manager->persist($materia);
        }

        $manager->flush();
    }

    private function getMaterias()
    {
        return [
            ['nombre' => 'Introducción a la Programación', 'nucleo' => 'núcleo básico obligatorio'],
            ['nombre' => 'Organización de Computadoras', 'nucleo' => 'núcleo básico obligatorio'],
            ['nombre' => 'Matemática', 'nucleo' => 'núcleo básico obligatorio'],
            ['nombre' => 'Programación con Objetos I', 'nucleo' => 'núcleo básico obligatorio'],
            ['nombre' => 'Bases de Datos', 'nucleo' => 'núcleo básico obligatorio'],
            ['nombre' => 'Estructuras de Datos', 'nucleo' => 'núcleo básico obligatorio'],
            ['nombre' => 'Programación con Objetos II', 'nucleo' => 'núcleo básico obligatorio'],
            ['nombre' => 'Redes de Computadoras', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Sistemas Operativos', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Programación Concurrente', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Matemática II', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Elementos de Ingeniería de Software', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Construcción de Interfaces de Usuario', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Estrategias de Persistencia', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Programación Funcional', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Desarrollo de Aplicaciones', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Laboratorio de Sistemas Operativos y Redes', 'nucleo' => 'núcleo avanzado obligatorio'],
            ['nombre' => 'Seguridad Informática', 'nucleo' => 'núcleo complementario'],
            ['nombre' => 'Bases de Datos II', 'nucleo' => 'núcleo complementario'],
            ['nombre' => 'Participación y Gestión en Proyectos de Software Libre', 'nucleo' => 'núcleo complementario'],
            ['nombre' => 'Introducción a las Arquitecturas de Software', 'nucleo' => 'núcleo complementario'],
            ['nombre' => 'Programación con Objetos III', 'nucleo' => 'núcleo complementario'],
            ['nombre' => 'Introducción al Desarrollo de Videojuegos', 'nucleo' => 'núcleo complementario'],
            ['nombre' => 'Seminarios', 'nucleo' => 'núcleo complementario'],
        ];
    }
}
