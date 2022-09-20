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
     * @throws UserNotFoundException
     */
    public function __invoke(int $id): User
    {
        $user = $this->repository->show(new UserId($id));
        $this->isset($user);
        return $user;
    }

    /**
     * @throws UserNotFoundException
     */
    private function isset(User $user): void
    {
        if (is_null($user->entity())) {
            throw new UserNotFoundException("User not found", 404);
        }
    }
}
