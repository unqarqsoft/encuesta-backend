<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Groups;

/**
 * Comision
 *
 * @ORM\Table(name="comision")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComisionRepository")
 */
class Comision
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @Groups({"stats", "list"})
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Oferta", inversedBy="comisiones")
     * @Exclude
     */
    private $oferta;

    /**
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="comision")
     * @Exclude
     */
    private $respuestas;

    /**
     * @ORM\Column(name="cupo_minimo", type="integer")
     * @Groups({"stats"})
     */
    private $cupoMinimo;

    /**
     * @ORM\Column(name="cupo_maximo", type="integer")
     * @Groups({"stats"})
     */
    private $cupoMaximo;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Comision
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
     * Set oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     *
     * @return Comision
     */
    public function setOferta(\AppBundle\Entity\Oferta $oferta = null)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return \AppBundle\Entity\Oferta
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Add respuesta
     *
     * @param \AppBundle\Entity\Respuesta $respuesta
     *
     * @return Comision
     */
    public function addRespuesta(\AppBundle\Entity\Respuesta $respuesta)
    {
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
     * @Groups({"stats"})
     */
    public function getTotal()
    {
        return count($this->respuestas);
    }

    /**
     * @VirtualProperty
     * @Groups({"stats"})
     */
    public function getStatus()
    {
        $total = $this->getTotal();
        if ($total < $this->cupoMinimo) {
            return 'BAJA';
        }
        if ($total > $this->cupoMaximo) {
            return 'ALTA';
        }

        return 'OK';
    }

    /**
     * Set cupoMinimo
     *
     * @param integer $cupoMinimo
     *
     * @return Comision
     */
    public function setCupoMinimo($cupoMinimo)
    {
        $this->cupoMinimo = $cupoMinimo;

        return $this;
    }

    /**
     * Get cupoMinimo
     *
     * @return integer
     */
    public function getCupoMinimo()
    {
        return $this->cupoMinimo;
    }

    /**
     * Set cupoMaximo
     *
     * @param integer $cupoMaximo
     *
     * @return Comision
     */
    public function setCupoMaximo($cupoMaximo)
    {
        $this->cupoMaximo = $cupoMaximo;

        return $this;
    }

    /**
     * Get cupoMaximo
     *
     * @return integer
     */
    public function getCupoMaximo()
    {
        return $this->cupoMaximo;
    }
}
