<?php

namespace App\MessageHandler;

use App\Message\MesNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MessNotificationHandler
{
    public function __invoke(MesNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}
