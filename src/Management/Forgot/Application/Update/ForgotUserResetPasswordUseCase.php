<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Application\Update;

use Src\Application\User\Domain\Exceptions\UserUpdateException;
use Src\Management\Forgot\Domain\Contracts\ForgotRepositoryContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotReset;

final class ForgotUserResetPasswordUseCase
{
    /**
     * @param ForgotRepositoryContract $repository
     */
    public function __construct(private ForgotRepositoryContract $repository)
    {
    }

    /**
     * @param array $reset
     * @return Forgot
     * @throws UserUpdateException
     */
    public function __invoke(array $reset): Forgot
    {
        $user =  $this->repository->reset(new ForgotReset([
            "email" => $reset["email"],
            "password" => $reset["password"]
        ]));
        $this->userStatus($user);
        return $user;
    }

    /**
     * @param Forgot $user
     * @return void
     * @throws UserUpdateException
     */
    private function userStatus(Forgot $user): void
    {
        if (is_null($user->entity())) {
            throw new UserUpdateException("Failed update user", 500);
        }
    }
}
