<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        // 1. Récupérer l'utilisateur (pour avoir son nickname)
        $user = $event->getUser();

        // 2. Enrichir les data pour qu'elles contiennet ces données
        $data = $event->getData();
        $data['nickname'] = $user->getNickname();

        $event->setData($data);
    }
}
