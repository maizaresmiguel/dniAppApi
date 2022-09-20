<?php

namespace App\Entity;

use App\Event\Dni\DniCreatedEvent;
use App\Form\Model\DestinoDto;
use App\Repository\DniRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Contracts\EventDispatcher\Event;


/**
 * @ORM\Entity(repositoryClass=DniRepository::class)
 */
class Dni
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idTramite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer")
     */
    private $dni;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaTramite;

    /**
     * @ORM\Column(type="integer")
     */
    private $codigo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $usuario;

    /**
     * @ORM\ManyToMany(targetEntity=Destino::class, inversedBy="dnis")
     */
    private $destinos;

    /**
     * @ORM\Column(type="integer")
     */
    private $estado;

    private $domainEvent;



    /**
     * Dni constructor.
     * @param int $idTramite
     * @param int $dni
     * @param string $nombre
     * @param string $apellido
     * @param string $sexo
     * @param DateTimeInterface|null $fechaNacimiento
     * @param DateTimeInterface|null $fechaTramite
     * @param int $codigo
     * @param int $estado
     * @param ...$destinos
     */
    public function __construct(
        int $idTramite,
        int $dni,
        string  $nombre,
        string  $apellido,
        string $sexo,
        ?DateTimeInterface $fechaNacimiento,
        ?DateTimeInterface $fechaTramite,
        int $codigo,
       // int $estado,
        Collection $destinos
    )
    {
        $this->idTramite=$idTramite;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->sexo = $sexo;
        $this->estado = 0;
        $this->codigo = $codigo;
        $this->fechaTramite=$fechaTramite;
        $this->fechaNacimiento = $fechaNacimiento;

       //TODO  agregar los campos fecha alta y usuario
       $this->destinos = $destinos ?? new ArrayCollection();
       $this->fechaAlta = new \DateTime();
       $this->usuario = 'usuarioTemporal';
    }
    /**
     * crea un objeto de la misma clase
     */
    public static function create(
        int $idTramite,
        int $dni,
        string  $nombre,
        string  $apellido,
        string $sexo,
        \DateTimeInterface $fechaNacimiento,
        \DateTimeInterface $fechaTramite,
        int $codigo,
       // int $estado,
         array $destinos ): self
    {
        $dni =  new self(
            $idTramite,
            $dni,
            $nombre,
            $apellido,
            $sexo,
            $fechaNacimiento,
            $fechaTramite,
            $codigo,
            //$estado,
            new ArrayCollection($destinos)
        );
         $dni->addDomainEvent( new DniCreatedEvent($dni->getDni()));
        return $dni;
    }

    public function addDomainEvent(Event $event):void
    {
        $this->domainEvent[] = $event;

    }
    public function pullDomianEvent()
    {
        return $this->domainEvent;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTramite(): ?int
    {
        return $this->idTramite;
    }

    public function setIdTramite(int $idTramite): self
    {
        $this->idTramite = $idTramite;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(int $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

   // public function setFechaNacimiento(): self
    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
       // $this->fechaNacimiento = new \DateTime();
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getFechaTramite(): ?\DateTimeInterface
    {
        return $this->fechaTramite;
    }

    public function setFechaTramite(\DateTimeInterface $fechaTramite): self
    {
        $this->fechaTramite = $fechaTramite;

        return $this;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }



    /**
     * @return Collection<int, Destino>
     */
    public function getDestinos(): Collection
    {
        return $this->destinos;
    }

    public function addDestino(Destino $destino): self
    {
        if (!$this->destinos->contains($destino)) {
            $this->destinos[] = $destino;
        }

        return $this;
    }

    public function removeDestino(Destino $destino): self
    {
        $this->destinos->removeElement($destino);

        return $this;
    }
    public function updateDestinos(Destino ...$newdestinos)
    {
        /** @var ArrayCollection<Destino> */
        $destinosOriginales = new ArrayCollection();

        foreach ($this->destinos as $destino)
        {
            $destinosOriginales->add($destino);
        }
        //remover destinos
        foreach ($destinosOriginales as $destinosOriginal)
        {
            if(!\in_array($destinosOriginal, $newdestinos,true))
            {
                $this->removeDestino($destinosOriginal);
            }
        }
        //Agregar destino
        foreach ($newdestinos as $nuevoDestino)
        {
            if(!$destinosOriginales->contains($nuevoDestino))
            {
                $this->addDestino($nuevoDestino);

            }
        }
    }

    public function update( string $idTramite,
                            string  $apellido,
                            string $nombre,
                            \DateTimeInterface $fechaNacimiento,
                            \DateTimeInterface $fechaTramite,
                            string $sexo,
                            int $dni,
                            int $codigo,
                            ?int $estado,
                            Destino ...$destinos)
    {
        $this->idTramite = $idTramite;
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->fechaTramite = $fechaTramite;
        $this->sexo = $sexo;
        $this->dni = $dni;
        $this->codigo = $codigo;
        $this->estado = $estado;
        $this->updateDestinos(...$destinos);
    }

    public function getEstado(): ?int
    {
        return $this->estado;
    }

    public function setEstado(int $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
