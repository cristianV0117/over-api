<?php

declare(strict_types=1);

namespace Src\Application\User\Domain;

use Src\Application\User\Domain\Exceptions\UserDestroyFailedException;
use Src\Application\User\Domain\Exceptions\UserNotFoundException;
use Src\Application\User\Domain\Exceptions\UserStoreFailedException;
use Src\Application\User\Domain\Exceptions\UserUpdateException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helpers\HttpCodesHelper;

final class User extends Domain
{
    use HttpCodesHelper;

    private const USER_NOT_FOUND = 'USER_NOT_FOUND';
    private const USER_UPDATED_FAILED = 'USER_UPDATED_FAILED';
    private const USER_STORE_FAILED = 'USER_STORE_FAILED';
    private const USER_DESTROY_FAILED = 'USER_DESTROY_FAILED';

    /**
     * @param string|null $exception
     * @return void
     * @throws UserNotFoundException
     * @throws UserUpdateException
     * @throws UserStoreFailedException
     * @throws UserDestroyFailedException
     */
    public function isException(?string $exception): void
    {
        if (!is_null($exception)) {
            match ($exception) {
                self::USER_NOT_FOUND => throw new UserNotFoundException("User not found", $this->notFound()),
                self::USER_UPDATED_FAILED => throw new UserUpdateException("Failed updated user", $this->internalServerError()),
                self::USER_STORE_FAILED => throw new UserStoreFailedException("Failed store user", $this->internalServerError()),
                self::USER_DESTROY_FAILED => throw new UserDestroyFailedException("Failed destroy user", $this->internalServerError())
            };
        }
    }

    protected function domainEvent(?string $event): void
    {
        // TODO: Implement domainEvent() method.
    }
}
