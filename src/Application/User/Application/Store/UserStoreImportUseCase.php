<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Store;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\Exceptions\UserImportFailedException;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserStoreImportCriteria;

final class UserStoreImportUseCase
{
    /**
     * @param UserRepositoryContract $userRepositoryContract
     */
    public function __construct(
        private readonly UserRepositoryContract $userRepositoryContract
    )
    {
    }

    /**
     * @param array $usersImport
     * @return User
     * @throws UserImportFailedException
     */
    public function __invoke(array $usersImport): User
    {
        return $this->userRepositoryContract->storeImport(new UserStoreImportCriteria($usersImport));
    }
}
