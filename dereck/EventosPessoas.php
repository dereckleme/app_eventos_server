<?php



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
    private $ideventosPessoas;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=false)
     */
    private $longitude;

    /**
     * @var \Eventos
     *
     * @ORM\ManyToOne(targetEntity="Eventos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evento_id", referencedColumnName="ideventos")
     * })
     */
    private $evento;


}
