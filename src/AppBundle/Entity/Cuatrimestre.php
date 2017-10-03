<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Cuatrimestre
 *
 * @ORM\Table(name="cuatrimestre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CuatrimestreRepository")
 */
class Cuatrimestre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @JMS\Groups({"list"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @Assert\NotBlank()
     *
     * @JMS\Groups({"list", "stats"})
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="anio", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $anio;

    /**
     * @var int
     *
     * @ORM\Column(name="periodo", type="integer")
     * @Assert\NotBlank()
     */
    private $periodo;

    /**
     * @ORM\ManyToOne(targetEntity="Carrera", inversedBy="cuatrimestres")
     * @Assert\NotBlank()
     *
     * @JMS\Groups({"list", "stats"})
     */
    private $carrera;

    /**
     * @ORM\OneToMany(targetEntity="Oferta", mappedBy="cuatrimestre")
     */
    private $ofertas;

    /**
     * @ORM\OneToMany(targetEntity="Encuesta", mappedBy="cuatrimestre")
     *
     * @JMS\Exclude
     */
    private $encuestas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ofertas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->encuestas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Cuatrimestre
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set anio
     *
     * @param string $anio
     *
     * @return Cuatrimestre
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return string
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set periodo
     *
     * @param integer $periodo
     *
     * @return Cuatrimestre
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return int
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set carrera
     *
     * @param \AppBundle\Entity\Carrera $carrera
     *
     * @return Cuatrimestre
     */
    public function setCarrera(\AppBundle\Entity\Carrera $carrera = null)
    {
        $this->carrera = $carrera;

        return $this;
    }

    /**
     * Get carrera
     *
     * @return \AppBundle\Entity\Carrera
     */
    public function getCarrera()
    {
        return $this->carrera;
    }

    /**
     * Add oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     *
     * @return Cuatrimestre
     */
    public function addOferta(\AppBundle\Entity\Oferta $oferta)
    {
        $this->ofertas[] = $oferta;

        return $this;
    }

    /**
     * Remove oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     */
    public function removeOferta(\AppBundle\Entity\Oferta $oferta)
    {
        $this->ofertas->removeElement($oferta);
    }

    /**
     * Get ofertas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfertas()
    {
        return $this->ofertas;
    }

    /**
     * Get encuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEncuestas()
    {
        return $this->encuestas;
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\Groups({"stats"})
     */
    public function getTotalEncuestas()
    {
        return count($this->encuestas);
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\Groups({"stats"})
     */
    public function getEncuestasCompletas()
    {
        return count($this->encuestas->filter(function($e) {
            return $e->getCompleta();
        }));
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\Groups({"stats"})
     */
    public function getPorcentaje()
    {
        $total = $this->getTotalEncuestas();
        if (!$total) {
            return 0;
        }

        return round(($this->getEncuestasCompletas() / $total) * 100, 2);
    }
}
