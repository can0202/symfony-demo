<?php

namespace App\Messenger;

class MailNotification
{
    private $content;

    public function __construct(mixed $content)
    {
        $this->content = $content;
    }

    public function getContent(): mixed
    {
        return $this->content;
    }
}
