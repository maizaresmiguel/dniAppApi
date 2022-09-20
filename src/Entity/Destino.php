<?php

namespace App\Entity;

use App\Repository\DestinoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=DestinoRepository::class)
 */
class Destino
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
    private $oficina;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaMovimiento;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $usuario;

    /**
     * @ORM\ManyToMany(targetEntity=Dni::class, mappedBy="destinos")
     */
    private $dnis;

    public function __construct(string $nombre, int $oficina, string $descripcion, \DateTimeInterface $fechaMovimiento)
    {
        $this->nombre = $nombre;
        $this->oficina = $oficina;
        $this->descripcion = $descripcion;
        $this->fechaMovimiento =$fechaMovimiento;
        $this->usuario = 'usuario temporal crear';
        $this->dnis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOficina(): ?int
    {
        return $this->oficina;
    }

    public function setOficina(int $oficina): self
    {
        $this->oficina = $oficina;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaMovimiento(): ?\DateTimeInterface
    {
        return $this->fechaMovimiento;
    }

    public function setFechaMovimiento(\DateTimeInterface $fechaMovimiento): self
    {
        $this->fechaMovimiento = $fechaMovimiento;

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
     * @return Collection<int, Dni>
     */
    public function getDnis(): Collection
    {
        return $this->dnis;
    }

    public function addDni(Dni $dni): self
    {
        if (!$this->dnis->contains($dni)) {
            $this->dnis[] = $dni;
            $dni->addDestino($this);
        }

        return $this;
    }

    public function removeDni(Dni $dni): self
    {
        if ($this->dnis->removeElement($dni)) {
            $dni->removeDestino($this);
        }

        return $this;
    }

    public static function create(string $nombre, int $oficina, string $descripcion, \DateTimeInterface $fechaMovimiento): self
    {
       // var_dump($oficina);exit();
        //$oficina2=intval($oficina)
        return new self($nombre, $oficina, $descripcion, $fechaMovimiento);
    }

    public function __toString()
    {
        return $this->nombre ?? 'Oficina';
    }
}
