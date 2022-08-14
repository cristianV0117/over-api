<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Get;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;

class UserIndexUseCase
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
     * @return User
     */
    public function __invoke(): User
    {
        return $this->repository->index();
    }
}
