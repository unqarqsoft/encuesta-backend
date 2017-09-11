<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrera
 *
 * @ORM\Table(name="carrera")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarreraRepository")
 */
class Carrera
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Cuatrimestre", mappedBy="carrera")
     */
    private $cuatrimestres;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cuatrimestres = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Carrera
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add cuatrimestre
     *
     * @param \AppBundle\Entity\Cuatrimestre $cuatrimestre
     *
     * @return Carrera
     */
    public function addCuatrimestre(\AppBundle\Entity\Cuatrimestre $cuatrimestre)
    {
        $this->cuatrimestres[] = $cuatrimestre;

        return $this;
    }

    /**
     * Remove cuatrimestre
     *
     * @param \AppBundle\Entity\Cuatrimestre $cuatrimestre
     */
    public function removeCuatrimestre(\AppBundle\Entity\Cuatrimestre $cuatrimestre)
    {
        $this->cuatrimestres->removeElement($cuatrimestre);
    }

    /**
     * Get cuatrimestres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCuatrimestres()
    {
        return $this->cuatrimestres;
    }
}
