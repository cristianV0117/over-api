<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Store;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\ValueObjects\UserStoreImportCriteria;

final class UserStoreImportUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepositoryContract
    )
    {
    }

    public function __invoke(array $usersImport)
    {
        return $this->userRepositoryContract->storeImport(new UserStoreImportCriteria($usersImport));
    }
}
