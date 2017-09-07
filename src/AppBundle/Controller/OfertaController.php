<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Oferta;
use AppBundle\Form\OfertaType;

class OfertaController extends AbstractRestController
{
    protected function getResourceClass()
    {
        return Oferta::class;
    }

    protected function getFormClass()
    {
        return OfertaType::class;
    }
}
