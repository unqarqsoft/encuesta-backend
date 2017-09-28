<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use AppBundle\Entity\Comision;
use AppBundle\Entity\Respuesta;
use AppBundle\Entity\Oferta;

class EstadisticaController extends FOSRestController
{
    /**
     * @Get("/estadisticas/comisiones")
     */
    public function comisionesAction()
    {
        $oferta = $this->getDoctrine()->getRepository(Oferta::class)->findAll();

        $context = new Context();
        $context->addGroup('stats');
        $view = $this->view($oferta);
        $view->setContext($context);

        return $this->handleView($view);
    }
}
