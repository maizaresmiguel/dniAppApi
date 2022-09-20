<?php


namespace App\Controller\Api;


use App\Form\Model\DestinoDto;
use App\Form\Type\DestinoFormType;
use App\Service\Destino\DestinoManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class DestinosController extends AbstractFOSRestController
{
    /**
     * crea un listado de todos los dni ingresados
     * @Rest\Get(path="/listado-destinos")
     * @Rest\View(serializerGroups={"dni"}, serializerEnableMaxDepthChecks=true)
     */
    public function listadoAction(DestinoManager $destinoManager)
    {
        return $destinoManager->getRepository()->findAll();
    }

    /**
     * crear un destino
     * @Rest\Post (path="/crear-destino")
     * @Rest\View(serializerGroups={"dni"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(Request $request, DestinoManager $destinoManager)
    {
        $destinoDto = new DestinoDto();
        $form = $this->createForm(DestinoFormType::class, $destinoDto);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $destino = $destinoManager->crear();
            $destino->setUsuario($destinoDto->usuario);
            $destino->setDescripcion($destinoDto->descripcion);
            $destino->setNombre($destinoDto->nombre);
            $destino->setFechaMovimiento($destinoDto->fechaMovimiento);
            $destino->setOficina($destinoDto->oficina);
            $destinoManager->guardar($destino);
            return $destino;
        }
        return $form;

//        $dni = $dniManager->crear();
//        [$dni,$error] = ($dniFormProcesor)($dni, $request);
//        $statusCode = $dni ? Response:: HTTP_CREATED : Response::HTTP_BAD_REQUEST;
//        $data = $dni ?? $error;
//        return View::create($data, $statusCode);

    }
}