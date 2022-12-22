<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Get;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\Exceptions\UserNotFoundException;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;

final class UserShowUseCase
{
    /**
     * @param UserRepositoryContract $repository
     */
    public function __construct(private UserRepositoryContract $repository)
    {
    }

    /**
     * @param int $id
     * @return User
     */
    public function __invoke(int $id): User
    {
        return $this->repository->show(new UserId($id));
    }
}
