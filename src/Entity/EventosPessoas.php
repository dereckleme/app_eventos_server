<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventosPessoas
 *
 * @ORM\Table(name="eventos_pessoas", indexes={@ORM\Index(name="index2", columns={"evento_id"})})
 * @ORM\Entity
 */
class EventosPessoas
{
    /**
     * @var int
     *
     * @ORM\Column(name="ideventos_pessoas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $ideventosPessoas;

    /**
     * @var string
     *
     * @ORM\Column(name="deviceId", type="string", length=255, nullable=false)
     */
    protected $deviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    protected $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=false)
     */
    protected $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=false)
     */
    protected $longitude;

    /**
     * @var \Eventos
     *
     * @ORM\ManyToOne(targetEntity="Eventos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evento_id", referencedColumnName="ideventos")
     * })
     */
    protected $evento;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->ideventosPessoas;
    }

    /**
     * @param int $ideventosPessoas
     */
    public function setIdeventosPessoas(int $ideventosPessoas): void
    {
        $this->ideventosPessoas = $ideventosPessoas;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return Eventos
     */
    public function getEvento(): Eventos
    {
        return $this->evento;
    }

    /**
     * @param Eventos $evento
     */
    public function setEvento(Eventos $evento): void
    {
        $this->evento = $evento;
    }

    /**
     * @return int
     */
    public function getDeviceId(): int
    {
        return $this->deviceId;
    }

    /**
     * @param int $deviceId
     */
    public function setDeviceId($deviceId): void
    {
        $this->deviceId = $deviceId;
    }
}
