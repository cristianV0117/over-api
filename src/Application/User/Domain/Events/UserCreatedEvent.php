<?php

namespace Src\Application\User\Domain\Events;

use Src\Application\User\Domain\User;
use stdClass;

final class UserCreatedEvent
{
    /**
     * @var stdClass
     */
    private stdClass $mail;

    /**
     * @param User $entity
     */
    public function __construct(private User $entity)
    {
        $this->mail = new stdClass();
    }

    /**
     * @return stdClass
     */
    public function mailNotification(): stdClass
    {
        $this->mail->subject = $this->mailSubject();
        $this->mail->message = $this->mailMessage();
        $this->mail->markdown = $this->markdown();
        $this->mail->from = $this->mailFrom();
        $this->mail->to = $this->entity->entity()["email"];
        return $this->mail;
    }

    /**
     * @return string
     */
    public function mailMessage(): string
    {
        return "Hola {$this->entity->entity()["user_name"]}, bienvenido a la aplicación OVER APP";
    }

    /**
     * @return string
     */
    private function mailSubject(): string
    {
        return "Bienvenido a OVER APP";
    }

    /**
     * @return string
     */
    private function markdown(): string
    {
        return 'Mails.UserCreated';
    }

    /**
     * @return string
     */
    private function mailFrom(): string
    {
        return 'overapp@gmail.com';
    }
}
