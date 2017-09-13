<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
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

    /**
     * @Get("/encuestas/token/{token}")
     */
    public function getByTokenAction($token)
    {
        $encuesta = $this->getRepository(Encuesta::class)->findOneByToken($token);

        return $this->handleView($this->view($encuesta));
    }
}
