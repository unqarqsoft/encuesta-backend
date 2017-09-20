<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Encuesta;
use AppBundle\Entity\Cuatrimestre;
use AppBundle\Entity\Alumno;
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

    /**
     * @Post("/encuestas/generar")
     *
     * @RequestParam(name="email", requirements=".+")
     * @RequestParam(name="cuatrimestre", requirements="\d+")
     */
    public function generarEncuestaAction(Request $request, ParamFetcher $paramFetcher)
    {
        $email = $paramFetcher->get('email');
        $cuatrimestre = $paramFetcher->get('cuatrimestre');

        $alumno = $this->getRepository(Alumno::class)->findOneByEmail($email);
        $encuesta = $this->getRepository(Encuesta::class)->findOneBy([
            'alumno' => $alumno,
            'cuatrimestre' => $cuatrimestre
        ]);

        if (!$encuesta) {
            $encuesta = $this->crearEncuesta($alumno, $cuatrimestre);
        }

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

    protected function crearEncuesta($alumno, $cuatrimestreId)
    {
        $em = $this->getDoctrine()->getManager();

        $encuesta = new Encuesta();
        $encuesta->setCuatrimestre($em->getReference(Cuatrimestre::class, $cuatrimestreId));
        $encuesta->setAlumno($alumno);

        $em->persist($encuesta);
        $em->flush();

        return $encuesta;
    }
}
