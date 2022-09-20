<?php


namespace App\Form\Model;


use App\Entity\Dni;

class DniDto
{
    public $idTramite = null;
    public $apellido= null;
    public $nombre= null;
    public $sexo;
    public $dni;
    public $fechaNacimiento;
    public $fechaTramite= null;
    public $codigo= null;
    public $destinos= null;
    public $estado=null;

    public function __construct()
    {
        $this->destinos = [];
    }

    public static function crearDesdeDni(Dni $dni):self
    {
        $dto = new self();
        $dto->idTramite       = $dni->getIdTramite();
        $dto->apellido        = $dni->getApellido();
        $dto->nombre          = $dni->getNombre();
        $dto->fechaNacimiento = $dni->getFechaNacimiento();
        $dto->fechaTramite    = $dni->getFechaTramite();
        $dto->sexo            = $dni->getSexo();
        $dto->codigo          = $dni->getCodigo();
        $dto->estado          = $dni->getEstado();

        return $dto;
    }

    public function createEmpty(): self
    {
        return new self();
    }




}