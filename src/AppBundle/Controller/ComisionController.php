<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comision;
use AppBundle\Form\ComisionType;

class ComisionController extends AbstractRestController
{
    protected function getResourceClass()
    {
        return Comision::class;
    }

    protected function getFormClass()
    {
        return ComisionType::class;
    }
}
