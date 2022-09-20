<?php
namespace App\Controller\Api;


use App\Entity\Dni;
use App\Repository\DniRepository;
use App\Service\Dni\DeleteDni;
use App\Service\Dni\DniFormProcesor;
use App\Service\Dni\GetDni;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class DniController extends AbstractFOSRestController
{
    /**
     * crea un listado de todos los dni ingresados
     * @Rest\Get(path="/listado")
     * @Rest\View(serializerGroups={"dni"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(DniRepository $dniRepository)
    {
        return $dniRepository->findAll();
    }

    /**
     * crea el ingreso de un nuevo dni
     * @Rest\Post (path="/dnicrear")
     * @Rest\View(serializerGroups={"dni"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
                        Request $request,
                        DniFormProcesor $dniFormProcesor
                        )
    {
        [$dni,$error] = ($dniFormProcesor)($request);
        $statusCode = $dni ? Response:: HTTP_CREATED : Response::HTTP_BAD_REQUEST;
        $data = $dni ?? $error;
        return View::create($data, $statusCode);

    }

    /**
     * @Rest\Put(path="/dni/edit/{id}")
     * @Rest\View(serializerGroups={"dni"}, serializerEnableMaxDepthChecks=true)
     */
    public function editAction(
        int $id,
        GetDni $getDni,
        Request $request,
        DniFormProcesor $dniFormProcesor
    ){
        try {
            [$dni,$error] = ($dniFormProcesor)( $request, $id);
            $statusCode = $dni ? Response:: HTTP_CREATED : Response::HTTP_BAD_REQUEST;
            $data = $dni ?? $error;
            return View::create($data, $statusCode);
        }catch (\Throwable $e)
        {
          //  var_dump($e);
            return View::create('Dni no fue encontrado', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * borrar Dni
     * @Rest\Delete(path="/dni/{id}")
     * @Rest\View(serializerGroups={"dni"}, serializerEnableMaxDepthChecks=true)
     */
    public function deletetAction(
        int $id,
        GetDni $getDni,
        DeleteDni $deleteDni
    ){
        $dni = ($getDni)($id);
        try {
            ($deleteDni)($dni);
        } catch ( \Throwable $t){
            return View::create('Dni no encontrado', Response::HTTP_BAD_REQUEST);
        }
        return View::create(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * buscar un  Dni
     * @Rest\Get (path="/buscar/{id}")
     * @Rest\View(serializerGroups={"dni"}, serializerEnableMaxDepthChecks=true)
     */
    public function buscarAction(
        int $id,
        DniRepository $dniRepository
    ){
        $dni =(GetDni)($id);
        if (!$dni){
            return View::create('Dni no encontrado', Response::HTTP_BAD_REQUEST);
        }
        return $dni;
    }
}