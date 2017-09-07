<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     */
    private $materia;

    /**
     * @ORM\ManyToOne(targetEntity="Cuatrimestre")
     */
    private $cuatrimestre;

    /**
     * @ORM\OneToMany(targetEntity="Comision",  mappedBy="oferta")
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
}
