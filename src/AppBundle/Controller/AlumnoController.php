<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Alumno;
use AppBundle\Form\AlumnoType;

class AlumnoController extends AbstractRestController
{
    protected function getResourceClass()
    {
        return Alumno::class;
    }

    protected function getFormClass()
    {
        return AlumnoType::class;
    }
}
