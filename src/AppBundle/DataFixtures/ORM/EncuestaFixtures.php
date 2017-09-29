<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Encuesta;
use AppBundle\Entity\Respuesta;

class EncuestaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cuatri = $this->getReference('cuatrimestre22017');
        for ($i=1; $i <= 100; $i++) {
            $encuesta = new Encuesta();
            $alumno = $this->getReference("alumno$i");
            $encuesta->setCuatrimestre($cuatri);
            $encuesta->setAlumno($alumno);
            $this->generateRespuestas($encuesta);

            $manager->persist($encuesta);
        }

        $manager->flush();
    }

    protected function generateRespuestas($encuesta)
    {
        $choices = [Respuesta::COMISION, Respuesta::APROBADA, Respuesta::NO_CURSA, Respuesta::NO_HORARIO];

        foreach ($encuesta->getCuatrimestre()->getOfertas() as $oferta) {
            $choice = $choices[array_rand($choices)];
            $respuesta = new Respuesta();
            $respuesta->setMateria($oferta->getMateria());
            $respuesta->setRespuesta($choice);

            if ($choice == Respuesta::COMISION) {
                $comisiones = $oferta->getComisiones();
                $respuesta->setComision($comisiones[array_rand($comisiones->toArray())]);
            }

            $encuesta->addRespuesta($respuesta);
        }
    }

    public function getDependencies()
    {
        return [AlumnoFixtures::class, OfertaFixtures::class];
    }
}
