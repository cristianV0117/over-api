<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Store;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserStore;

final class UserStoreUseCase
{
    /**
     * @var UserRepositoryContract
     */
    private UserRepositoryContract $repository;

    /**
     * @param UserRepositoryContract $repository
     */
    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $store
     * @return User
     */
    public function __invoke(array $store): User
    {
        return $this->repository->store(new UserStore($store));
    }
}
