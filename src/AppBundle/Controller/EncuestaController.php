<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Encuesta;
use AppBundle\Form\EncuestaType;
use AppBundle\Form\EncuestaRespuestasType;

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

    public function putRespuestasAction($id, Request $request)
    {
        $encuesta = $this->getEntity($id);
        $respuestas = $encuesta->getRespuestas()->toArray();
        $form = $this->get('form.factory')->createNamed('', EncuestaRespuestasType::class, $encuesta, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($respuestas as $respuesta) {
                $this->get('logger')->info($respuesta->getRespuesta());
                if (false === $encuesta->getRespuestas()->contains($respuesta)) {
                    $respuesta->setEncuesta(null);
                    $em->remove($respuesta);
                }
            }

            $em->persist($encuesta);
            $em->flush();

            return $this->handleView($this->view($encuesta));
        }

        return $this->handleView($this->view($form));
    }
}
