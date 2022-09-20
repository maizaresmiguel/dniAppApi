<?php


namespace App\Form\Model;


use App\Entity\Destino;

class DestinoDto
{
    public $id;
    public $oficina;
    public $nombre;
    public $descripcion;
    public $fechaMovimiento;
    public $usuario;

    public function __construct(){
        $this->destinos = [];
    }

    public static function crearDesdeDestino(Destino $destino): self
    {
        $dto = new self();
        $dto->oficina = $destino->getOficina();
        $dto->id = $destino->getId();
        $dto->nombre = $destino->getNombre();
        $dto->descripcion = $destino->getDescripcion();
        $dto->fechaMovimiento = $destino->getFechaMovimiento();
        $dto->usuario = $destino->getUsuario();
        return $dto;
    }




}