<?php
namespace App\Event\Dni;

use Symfony\Contracts\EventDispatcher\Event;

class DniCreatedEvent extends Event{
    public const NAME = 'dni.creado';

    private $dniId;


    public function __construct(int $id)
    {
        $this->dniId = $id;
    }

    /**
     * @return int
     */
    public function getDniId(): int
    {
        return $this->dniId;
    }
}