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
        $oferta = new Oferta();
        $oferta->setMateria($this->getReference('materia1'));
        $oferta->setCuatrimestre($this->getReference('cuatrimestre22017'));
        
        for ($i = 1; $i <= 3; $i++) {
            $comision = new Comision();
            $comision->setDescripcion("Comision $i");
            $oferta->addComision($comision);
        }

        $manager->persist($oferta);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CuatrimestreFixtures::class, MateriaFixtures::class];
    }
}
