<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Domain\ValueObjects;

use Src\Shared\Domain\Helpers\EnvHelper;
use Src\Shared\Domain\ValueObjects\StringValueObject;
use stdClass;

final class ForgotMailable extends StringValueObject
{
    use EnvHelper;

    /**
     * @var stdClass
     */
    private stdClass $mailObject;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->mailObject = new stdClass();
        $this->setWebDomain();
        $this->setFrom();
        $this->setSubject();
        $this->setMarkdown();
    }

    /**
     * @return stdClass
     */
    public function object(): stdClass
    {
        return $this->mailObject;
    }

    public function setWebDomain(): void
    {
        $this->mailObject->resetPassword = $this->webDomain() . '/auth/reset-password/' . base64_encode($this->value());
    }

    public function setFrom(): void
    {
        $this->mailObject->from = 'overapp@gmail.com';
    }

    public function setSubject(): void
    {
        $this->mailObject->subject = 'Recuperar contraseña OVER APP';
    }

    public function setMarkdown(): void
    {
        $this->mailObject->markdown = 'mails.Forgot';
    }
}
