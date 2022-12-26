<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Domain;

use Src\Application\User\Domain\Exceptions\UserNotFoundException;
use Src\Application\User\Domain\Exceptions\UserUpdateException;
use Src\Management\Forgot\Domain\Exceptions\MailFailedException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helpers\HttpCodesHelper;

final class Forgot extends Domain
{
    use HttpCodesHelper;

    private const MAIL_FAILED = 'MAIL_FAILED';
    private const UPDATE_PASSWORD_USER_FAILED = 'UPDATE_PASSWORD_USER_FAILED';
    private const USER_NOT_FOUND = 'USER_NOT_FOUND';

    /**
     * @throws MailFailedException
     * @throws UserUpdateException
     * @throws UserNotFoundException
     */
    protected function isException(?string $exception): void
    {
        if (!is_null($exception)) {
            match ($exception) {
                self::MAIL_FAILED => throw new MailFailedException("No se puedo envíar el correo", $this->internalServerError()),
                self::USER_NOT_FOUND => throw new UserNotFoundException("User not found", $this->notFound()),
                self::UPDATE_PASSWORD_USER_FAILED => throw new UserUpdateException("Failed update user", $this->internalServerError())
            };
        }
    }
}
