<?php
namespace App\Service\Destino;

use App\Entity\Destino;
use App\Repository\DestinoRepository;
use Doctrine\ORM\EntityManagerInterface;


class DestinoManager{
    private $em;
    private $destinoRepository;

    public function __construct(EntityManagerInterface $em, DestinoRepository $destinoRepository){
        $this->em = $em;
        $this->destinoRepository = $destinoRepository;
    }

    public function find(int $id){
        return $this->destinoRepository->find($id);
    }

    public function crear(){
        $destino = new Destino();
        return $destino;
    }
    public function persist( Destino $destino):Destino
    {
        $this->em->persist($destino);
        return $destino;
    }

    public function guardar( Destino $destino): Destino
    {
        $this->em->persist($destino);
        $this->em->flush();
        return $destino;
    }
    public function recargar(Destino $destino): Destino
    {
        $this->em->refresh($destino);
        return $destino;
    }
    public function getRepository()
    {
        return $this->destinoRepository;
    }

}
