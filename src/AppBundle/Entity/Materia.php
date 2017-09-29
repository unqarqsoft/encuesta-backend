<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Groups;

/**
 * Materia
 *
 * @ORM\Table(name="materia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MateriaRepository")
 * @UniqueEntity("nombre")
 */
class Materia
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Groups({"stats", "list"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nucleo", type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"stats", "list"})
     */
    private $nucleo;


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
     * @return Materia
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
     * Set nucleo
     *
     * @param string $nucleo
     *
     * @return Materia
     */
    public function setNucleo($nucleo)
    {
        $this->nucleo = $nucleo;

        return $this;
    }

    /**
     * Get nucleo
     *
     * @return string
     */
    public function getNucleo()
    {
        return $this->nucleo;
    }
}
