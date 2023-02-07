<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Destroy;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\Exceptions\UserDestroyFailedException;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;

final class UserDestroyUseCase
{
    /**
     * @param UserRepositoryContract $repository
     */
    public function __construct(private readonly UserRepositoryContract $repository)
    {
    }

    /**
     * @param int $id
     * @return User
     */
    public function __invoke(int $id): User
    {
        return $this->repository->destroy(new UserId($id));
    }
}
