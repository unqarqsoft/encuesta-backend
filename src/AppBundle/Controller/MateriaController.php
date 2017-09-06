<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Materia;
use AppBundle\Form\MateriaType;

class MateriaController extends AbstractRestController
{
    protected function getResourceClass()
    {
        return Materia::class;
    }

    protected function getFormClass()
    {
        return MateriaType::class;
    }
}
