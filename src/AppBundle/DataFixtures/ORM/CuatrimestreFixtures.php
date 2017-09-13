<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Cuatrimestre;

class CuatrimestreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cuatrimestre = new Cuatrimestre();
        $cuatrimestre->setDescripcion('Segundo cuatrimestre 2017');
        $cuatrimestre->setAnio('2017');
        $cuatrimestre->setPeriodo(2);
        $cuatrimestre->setCarrera($this->getReference('carrera-tpi'));

        $this->addReference('cuatrimestre22017', $cuatrimestre);
        $manager->persist($cuatrimestre);

        $cuatrimestre = new Cuatrimestre();
        $cuatrimestre->setDescripcion('Segundo cuatrimestre 2017');
        $cuatrimestre->setAnio('2017');
        $cuatrimestre->setPeriodo(2);
        $cuatrimestre->setCarrera($this->getReference('carrera-lds'));

        $this->addReference('cuatrimestre22017-lds', $cuatrimestre);
        $manager->persist($cuatrimestre);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CarreraFixtures::class];
    }
}
