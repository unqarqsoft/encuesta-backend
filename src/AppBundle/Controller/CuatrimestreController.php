<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cuatrimestre;
use AppBundle\Form\CuatrimestreType;

class CuatrimestreController extends AbstractRestController
{
    protected function getResourceClass()
    {
        return Cuatrimestre::class;
    }

    protected function getFormClass()
    {
        return CuatrimestreType::class;
    }
}
