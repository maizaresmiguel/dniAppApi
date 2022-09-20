<?php


namespace App\Service\Destino;


use App\Entity\Destino;
use App\Repository\DestinoRepository;

class GetDestino
{
    private $destinoRepository;
    public function __construct( DestinoRepository $destinoRepository)
    {
        $this->destinoRepository = $destinoRepository;
    }

    public function __invoke(int $id): ?Destino
    {
        $destino = $this->destinoRepository->find($id);
        if (!$destino) {
            CategoryNotFound::throwException();
        }

        return $destino;
    }
}