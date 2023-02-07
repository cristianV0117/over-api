<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Update;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\Exceptions\UserUpdateException;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;
use Src\Application\User\Domain\ValueObjects\UserUpdate;

final class UserUpdateUseCase
{
    /**
     * @param UserRepositoryContract $repository
     */
    public function __construct(private readonly UserRepositoryContract $repository)
    {
    }

    /**
     * @param array $update
     * @param int $id
     * @return User
     */
    public function __invoke(array $update, int $id): User
    {
        return $this->repository->update(new UserId($id), new UserUpdate($update));
    }
}
