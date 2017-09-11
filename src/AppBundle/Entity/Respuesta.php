<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RespuestaRepository")
 */
class Respuesta
{
    const NO_CURSA = 'NO_CURSA';
    const NO_HORARIO = 'NO_HORARIO';
    const COMISION = 'COMISION';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="respuesta", type="string", length=255)
     */
    private $respuesta;

    /**
     * @ORM\ManyToOne(targetEntity="Comision")
     * @ORM\JoinColumn(nullable=true)
     */
    private $comision;

    /**
     * @ORM\ManyToOne(targetEntity="Encuesta", inversedBy="respuestas")
     */
    private $encuesta;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set respuesta
     *
     * @param string $respuesta
     *
     * @return Respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set comision
     *
     * @param \AppBundle\Entity\Comision $comision
     *
     * @return Respuesta
     */
    public function setComision(\AppBundle\Entity\Comision $comision = null)
    {
        $this->comision = $comision;

        return $this;
    }

    /**
     * Get comision
     *
     * @return \AppBundle\Entity\Comision
     */
    public function getComision()
    {
        return $this->comision;
    }

    /**
     * Set encuesta
     *
     * @param \AppBundle\Entity\Encuesta $encuesta
     *
     * @return Respuesta
     */
    public function setEncuesta(\AppBundle\Entity\Encuesta $encuesta = null)
    {
        $this->encuesta = $encuesta;

        return $this;
    }

    /**
     * Get encuesta
     *
     * @return \AppBundle\Entity\Encuesta
     */
    public function getEncuesta()
    {
        return $this->encuesta;
    }
}
