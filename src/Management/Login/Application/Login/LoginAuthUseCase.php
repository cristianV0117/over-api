<?php

declare(strict_types=1);

namespace Src\Management\Login\Application\Login;

use Src\Management\Login\Application\Auth\LoginAuthenticationUseCase;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginCriteria;

final class LoginAuthUseCase
{
    /**
     * @param LoginRepositoryContract $repository
     * @param LoginAuthenticationUseCase $authenticationUseCase
     */
    public function __construct(
        private LoginRepositoryContract $repository,
        private LoginAuthenticationUseCase $authenticationUseCase
    )
    {
    }

    /**
     * @param array $criteria
     * @return Login
     */
    public function __invoke(array $criteria): Login
    {
        $login = $this->repository->login(new LoginCriteria($criteria));
        return new Login(array_merge($login->handler(), [
            "jwt" => $this->authenticationUseCase->__invoke($login->handler())
        ]));
    }
}
