<?php


namespace App\Service\Dni;


use App\Entity\Dni;
use App\Repository\DniRepository;

class GetDni
{
    private  $dniRepository;

    public function __construct(DniRepository $dniRepository){
        $this->dniRepository = $dniRepository;
    }

    public function __invoke(int $id): ?Dni
    {
        $dni = $this->dniRepository->find($id);
        if (!$dni) {
            BookNotFound::throwException();
        }
        return $dni;
    }


}