<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Carrera;
use AppBundle\Form\CarreraType;

class CarreraController extends AbstractRestController
{
    protected function getResourceClass()
    {
        return Carrera::class;
    }

    protected function getFormClass()
    {
        return CarreraType::class;
    }
}
