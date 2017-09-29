<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RespuestaRepository")
 */
class Respuesta
{
    const APROBADA = 'APROBADA';
    const NO_CURSA = 'NO_CURSA';
    const NO_HORARIO = 'NO_HORARIO';
    const COMISION = 'COMISION';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"list"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="respuesta", type="string", length=255)
     * @Assert\NotBlank()
     *
     * @Groups({"list"})
     */
    private $respuesta;

    /**
     * @ORM\ManyToOne(targetEntity="Materia")
     * @Assert\NotBlank()
     *
     * @Groups({"list"})
     */
    private $materia;

    /**
     * @ORM\ManyToOne(targetEntity="Comision", inversedBy="respuestas")
     * @ORM\JoinColumn(nullable=true)
     *
     * @Groups({"list"})
     */
    private $comision;

    /**
     * @ORM\ManyToOne(targetEntity="Encuesta", inversedBy="respuestas")
     * @Assert\NotBlank()
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

    /**
     * Set materia
     *
     * @param \AppBundle\Entity\Materia $materia
     *
     * @return Respuesta
     */
    public function setMateria(\AppBundle\Entity\Materia $materia = null)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return \AppBundle\Entity\Materia
     */
    public function getMateria()
    {
        return $this->materia;
    }
}
