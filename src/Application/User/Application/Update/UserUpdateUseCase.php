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
    public function __construct(private UserRepositoryContract $repository)
    {
    }

    /**
     * @param array $update
     * @param int $id
     * @return User
     * @throws UserUpdateException
     */
    public function __invoke(array $update, int $id): User
    {
        $update = $this->repository->update(new UserId($id), new UserUpdate($update));
        $this->statusUpdate($update);
        return $update;
    }

    /**
     * @param User $update
     * @return void
     * @throws UserUpdateException
     */
    private function statusUpdate(User $update): void
    {
        if (is_null($update->entity())) {
            throw new UserUpdateException(
                $update->exceptionMessage() ?? "An error has occurred",
                $update->exceptionCode() ?? 500
            );
        }
    }
}
