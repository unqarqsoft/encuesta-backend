<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Oferta
 *
 * @ORM\Table(name="oferta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfertaRepository")
 */
class Oferta
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
     * @ORM\ManyToOne(targetEntity="Materia")
     * @Groups({"stats"})
     */
    private $materia;

    /**
     * @ORM\ManyToOne(targetEntity="Cuatrimestre", inversedBy="ofertas")
     */
    private $cuatrimestre;

    /**
     * @ORM\OneToMany(targetEntity="Comision", mappedBy="oferta", cascade={"persist"})
     * @Groups({"stats"})
     */
    private $comisiones;

    public function __construct()
    {
        $this->comisiones = new ArrayCollection();
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
     * Set materia
     *
     * @param \AppBundle\Entity\Materia $materia
     *
     * @return Oferta
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

    /**
     * Set cuatrimestre
     *
     * @param \AppBundle\Entity\Cuatrimestre $cuatrimestre
     *
     * @return Oferta
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
     * Add comision
     *
     * @param \AppBundle\Entity\Comision $comision
     *
     * @return Oferta
     */
    public function addComision(\AppBundle\Entity\Comision $comisione)
    {
        $this->comisiones[] = $comisione;

        return $this;
    }

    /**
     * Remove comision
     *
     * @param \AppBundle\Entity\Comision $comision
     */
    public function removeComision(\AppBundle\Entity\Comision $comisione)
    {
        $this->comisiones->removeElement($comisione);
    }

    /**
     * Get comisiones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComisiones()
    {
        return $this->comisiones;
    }

    /**
     * @VirtualProperty
     * @Groups({"stats"})
     */
    public function getTotal()
    {
        $sum = 0;
        foreach ($this->getComisiones() as $comision) {
            $sum += $comision->getTotal();
        }

        return $sum;
    }
}
