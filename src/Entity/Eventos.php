<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Eventos
 *
 * @ORM\Table(name="eventos")
 * @ORM\Entity
 */
class Eventos
{
    /**
     * @var int
     *
     * @ORM\Column(name="ideventos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $ideventos;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    protected $titulo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    protected $latitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    protected $longitude;

    /**
     * @ORM\OneToMany(targetEntity="EventosPessoas", mappedBy="evento", cascade={"all"})
     */
    protected $pesssoas;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expira", type="datetime")
     */
    protected $expira;

    /**
     * VarejoOferta constructor.
     */
    public function __construct()
    {
        $this->pesssoas = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->ideventos;
    }

    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     */
    public function setLatitude(?string $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     */
    public function setLongitude(?string $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getPesssoas()
    {
        return $this->pesssoas;
    }

    /**
     * @param mixed $pesssoas
     */
    public function setPesssoas($pesssoas): void
    {
        $this->pesssoas = $pesssoas;
    }

    /**
     * Get Data
     *
     * @return \DateTime
     */
    public function getExpira()
    {
        return $this->expira;
    }

    /**
     * Set Data
     *
     * @param string $data
     */
    public function setExpira($data)
    {
        $this->expira = $data;

        return $this;
    }
}
