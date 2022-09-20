<?php


namespace App\Service\Destino;


use App\Entity\Destino;
use App\Repository\DestinoRepository;

class CrearDestino
{

    private $destinoRepository;
    public function __construct(DestinoRepository $destinoRepository)
    {
        $this->destinoRepository = $destinoRepository;
    }

    public function __invoke(string $nombre, int  $oficina, string $descripcion, \DateTimeInterface $fechaMovimiento): Destino
    {


        $destino = Destino::create($nombre, $oficina, $descripcion, $fechaMovimiento);

       //  var_dump($destino);exit();
        $this->destinoRepository->save($destino);
        return $destino;
    }

}