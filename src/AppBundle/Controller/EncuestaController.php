<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Encuesta;
use AppBundle\Form\EncuestaType;

class EncuestaController extends AbstractRestController
{
    protected function getResourceClass()
    {
        return Encuesta::class;
    }

    protected function getFormClass()
    {
        return EncuestaType::class;
    }
}
