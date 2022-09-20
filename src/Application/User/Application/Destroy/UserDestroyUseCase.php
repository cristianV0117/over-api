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
    public function __construct(private UserRepositoryContract $repository)
    {
    }

    /**
     * @param int $id
     * @return User
     * @throws UserDestroyFailedException
     */
    public function __invoke(int $id): User
    {
        $destroy = $this->repository->destroy(new UserId($id));
        $this->statusDestroy($destroy);
        return $destroy;
    }

    /**
     * @param User $destroy
     * @return void
     * @throws UserDestroyFailedException
     */
    private function statusDestroy(User $destroy): void
    {
        if (is_null($destroy->entity())) {
            throw new UserDestroyFailedException(
                $destroy->exceptionMessage() ?? "An error has occurred",
                $destroy->exceptionCode() ?? 500
            );
        }
    }
}
