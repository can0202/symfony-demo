<?php

namespace App\MessageHandler;

use App\Message\MesNotification;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MessNotificationHandler
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

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
