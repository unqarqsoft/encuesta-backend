<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRestController extends FOSRestController implements ClassResourceInterface
{
    abstract protected function getResourceClass();

    abstract protected function getFormClass();

    protected function getEntity($id)
    {
        return $this->getDoctrine()->getRepository($this->getResourceClass())->find($id);
    }

    protected function getRepository($class)
    {
        return $this->getDoctrine()->getRepository($class);
    }


    public function cgetAction()
    {
        $data = $this->getDoctrine()->getRepository($this->getResourceClass())->findAll();
        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function postAction(Request $request)
    {
        $cls = new \ReflectionClass($this->getResourceClass());
        $object = $cls->newInstance();
        $form = $this->get('form.factory')->createNamed('', $this->getFormClass(), $object);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();

            return $this->handleView($this->view($object));
        }

        if (!$form->isSubmitted()) {
            $form->submit([]);
        }

        return $this->handleView($this->view($form));
    }

    public function getAction($id)
    {
        $data = $this->getDoctrine()->getRepository($this->getResourceClass())->find($id);

        return $this->handleView($this->view($data));
    }
}
