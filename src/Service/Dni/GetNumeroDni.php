<?php


namespace App\Service\Dni;


use App\Entity\Dni;
use App\Repository\DniRepository;

class GetNumeroDni
{
    private  $dniRepository;

    public function __construct(DniRepository $dniRepository){
        $this->dniRepository = $dniRepository;
    }

    public function __invoke(int $dni): ?Dni
    {
        return $this->dniRepository->findOneBy(['dni' =>$dni ]);
    }


}