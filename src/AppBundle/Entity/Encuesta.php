<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Encuesta
 *
 * @ORM\Table(name="encuesta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EncuestaRepository")
 */
class Encuesta
{
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
     * @ORM\Column(name="token", type="string", length=255, unique=true)
     */
    private $token;

    /**
     * @ORM\ManyToOne(targetEntity="Cuatrimestre")
     * @Assert\NotBlank()
     */
    private $cuatrimestre;

    /**
     * @ORM\ManyToOne(targetEntity="Alumno")
     * @Assert\NotBlank()
     */
    private $alumno;

    /**
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="encuesta", cascade={"persist", "remove"})
     * @Assert\Valid
     */
    private $respuestas;

    public function __construct()
    {
        $this->token = Uuid::uuid4();
        $this->respuestas = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set token
     *
     * @param string $token
     *
     * @return Encuesta
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set cuatrimestre
     *
     * @param \AppBundle\Entity\Cuatrimestre $cuatrimestre
     *
     * @return Encuesta
     */
    public function setCuatrimestre(\AppBundle\Entity\Cuatrimestre $cuatrimestre = null)
    {
        $this->cuatrimestre = $cuatrimestre;

        return $this;
    }

    /**
     * Get cuatrimestre
     *
     * @return \AppBundle\Entity\Cuatrimestre
     */
    public function getCuatrimestre()
    {
        return $this->cuatrimestre;
    }

    /**
     * Set alumno
     *
     * @param \AppBundle\Entity\Alumno $alumno
     *
     * @return Encuesta
     */
    public function setAlumno(\AppBundle\Entity\Alumno $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return \AppBundle\Entity\Alumno
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Add respuesta
     *
     * @param \AppBundle\Entity\Respuesta $respuesta
     *
     * @return Encuesta
     */
    public function addRespuesta(\AppBundle\Entity\Respuesta $respuesta)
    {
        $respuesta->setEncuesta($this);
        $this->respuestas[] = $respuesta;

        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \AppBundle\Entity\Respuesta $respuesta
     */
    public function removeRespuesta(\AppBundle\Entity\Respuesta $respuesta)
    {
        $this->respuestas->removeElement($respuesta);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * @VirtualProperty
     */
    public function getCompleta()
    {
        return count($this->respuestas) == count($this->cuatrimestre->getOfertas());
    }
}
