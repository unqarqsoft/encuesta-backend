<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @Assert\NotBlank()
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
}
