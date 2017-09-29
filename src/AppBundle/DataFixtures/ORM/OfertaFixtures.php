<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Oferta;
use AppBundle\Entity\Comision;

class OfertaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 23; $i++) {
            $oferta = new Oferta();
            $oferta->setMateria($this->getReference("materia$i"));
            $oferta->setCuatrimestre($this->getReference('cuatrimestre22017'));

            $this->addComisiones($oferta);
            $manager->persist($oferta);
        }

        $manager->flush();
    }

    protected function addComisiones($oferta)
    {
        for ($i = 1; $i <= 3; $i++) {
            $comision = new Comision();
            $comision->setDescripcion("Comision $i");
            $comision->setOferta($oferta);
            $comision->setCupoMinimo(5);
            $comision->setCupoMaximo(25);
            $oferta->addComision($comision);
        }
    }

    public function getDependencies()
    {
        return [CuatrimestreFixtures::class, MateriaFixtures::class];
    }
}
