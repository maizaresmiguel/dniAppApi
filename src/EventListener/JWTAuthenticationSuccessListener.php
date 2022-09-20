<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class JWTAuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $data = [
            "code" => 200,
            "message" => "autenticacion satisfactoria",
            "data" => $event->getData()
        ];
        $event->setData($data);
    }
}