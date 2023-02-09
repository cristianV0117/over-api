<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Application\Update;

use Src\Management\Forgot\Domain\Contracts\ForgotRepositoryContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotReset;

final class ForgotUserResetPasswordUseCase
{
    /**
     * @param ForgotRepositoryContract $repository
     */
    public function __construct(private readonly ForgotRepositoryContract $repository)
    {
    }

    /**
     * @param array $reset
     * @return Forgot
     */
    public function __invoke(array $reset): Forgot
    {
        return $this->repository->reset(new ForgotReset([
            "email" => $reset["email"],
            "password" => $reset["password"]
        ]));
    }
}
