<?php

namespace App\MessageHandler;

use App\Message\MesNotification;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MessNotificationHandler
{

    public function __invoke(MesNotification $message)
    {
        try {
            $email = (new TemplatedEmail())
                ->from('hello@example.com')
                ->to('you@example.com')
                ->subject('You have new post!')
                // ->text($message->getContent())
                ->htmlTemplate('emails/email.html.twig')
                ->context(['post' => $message->getContent()]);

            $this->mailer->send($email);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
