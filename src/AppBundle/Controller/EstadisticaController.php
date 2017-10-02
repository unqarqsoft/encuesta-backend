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

    /**
     * @Get("/estadisticas/horario")
     */
    public function horarioAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("
          SELECT m as materia, count(r.id) as total
          FROM AppBundle:Materia m JOIN AppBundle:Respuesta r WITH r.materia = m.id
          WHERE r.respuesta = ?1
          GROUP BY m.id
          ORDER BY total DESC
        ");
        $query->setParameter(1, Respuesta::NO_HORARIO);

        $view = $this->view($query->getResult());

        return $this->handleView($view);
    }
}
