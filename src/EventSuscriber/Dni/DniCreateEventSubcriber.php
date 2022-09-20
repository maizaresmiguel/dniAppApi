<?php


namespace App\EventSuscriber\Dni;


use App\Event\Dni\DniCreatedEvent;
use App\Service\Dni\GetNumeroDni;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;

class DniCreateEventSubcriber implements EventSubscriberInterface
{
    protected $logger;
    private $getNumeroDni;

    public function __construct(GetNumeroDni $getNumeroDni, LoggerInterface $logger)
    {
        $this->getNumeroDni = $getNumeroDni;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            DniCreatedEvent::class => ['onDniCreado']
        ];
    }
    public function onDniCreado(DniCreatedEvent $event)
    {
        $dni = ($this->getNumeroDni)($event->getDniId());
        $this->logger->info(sprintf('Dni creado:%s', $dni->getApellido()));


    }
}