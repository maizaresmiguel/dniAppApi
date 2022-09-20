<?php
namespace App\Service\Dni;


use App\Entity\Dni;
use App\Form\Model\DestinoDto;
use App\Form\Model\DniDto;
use App\Form\Type\DniFormType;
use App\Repository\DniRepository;
use App\Service\Destino\CrearDestino;
use App\Service\Destino\DestinoManager;
use App\Service\Destino\GetDestino;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\This;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;


class DniFormProcesor{


    private $destinoManager;
    private $formFactory;
    private $getDestino;
    private $getDni;
    private $crearDestino;
    private $dniRepository;
    private $eventDispatcher;

    public function __construct( CrearDestino $crearDestino,
                                 DestinoManager $destinoManager,
                                 FormFactoryInterface $formFactory,
                                 GetDestino $getDestino,
                                 DniRepository $dniRepository,
                                 EventDispatcherInterface $eventDispatcher,
                                 GetDni $getDni
                                )
    {
        $this->destinoManager = $destinoManager;
        $this->formFactory = $formFactory;
        $this->getDestino = $getDestino;
        $this->crearDestino = $crearDestino;
        $this->dniRepository = $dniRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->getDni = $getDni;
    }

    public function __invoke( Request $request, ?int $dniId ): array
    {

        $dni=null;
        if ($dniId === null)
        {
            //var_dump($dniId,'true');
            $dniDto = DniDto::createEmpty();
        } else {
            $dni = ($this->getDni)($dniId);
            $dniDto = DniDto::crearDesdeDni($dni);
            foreach ($dni->getDestinos() as $destino)
            {
                $dniDto->destinos[] = DestinoDto::crearDesdeDestino($destino);
            }
        }

        $content = json_decode($request->getContent(), true);
        $form = $this->formFactory->create(DniFormType::class, $dniDto);
        //$form->handleRequest($request);
        $form->submit($content);
        if(!$form->isSubmitted())
        { //devolvemos un array [exito, error]
            return [null, 'Formulario no submiteado'];
        }
        if (!$form->isValid())
        {
            return [null, $form];
        }
        $destinos = [];
        //var_dump($dniDto->destinos);exit();
        foreach ($dniDto->destinos as $nuevoDestinoDto)
        {
            $destino = null;
            if ($nuevoDestinoDto->id !== null)
            {
                $destino = ($this->getDestino)($nuevoDestinoDto->id);
            }
            if ($destino===null)
            {
                $destino = ($this->crearDestino)( $nuevoDestinoDto->nombre, $nuevoDestinoDto->oficina,
                                                   $nuevoDestinoDto->descripcion, $nuevoDestinoDto->fechaMovimiento);
            }
            $destinos[]=$destino;
        }
        if ($dni === null)
        {
            print_r('hola mundo update1');
          //  dd($form->getData());
         $dni = Dni::create(
             $dniDto->idTramite,
             $dniDto->dni,
             $dniDto->nombre,
             $dniDto->apellido,
             $dniDto->sexo,
             $dniDto->fechaNacimiento,
             $dniDto->fechaTramite,
             $dniDto->codigo,
//             $dniDto->estado,
             $destinos
         );
         //dd($dni);
        }else{
            print_r('hola mundo update2');
            //var_dump($dniDto->apellido);exit();

            $dni->update($dniDto->idTramite, $dniDto->apellido, $dniDto->nombre,
                $dniDto->fechaNacimiento, $dniDto->fechaTramite, $dniDto->sexo,
                $dniDto->dni, $dniDto->codigo, $dniDto->estado, ...$destinos
            );
        }
        //var_dump($dni->getApellido());exit();
        $this->dniRepository->guardar($dni);
        foreach ($dni->pullDomianEvent() as $event)
        {
            $this->eventDispatcher->dispatch($event);
        }
        return[$dni, null];

    }

}
