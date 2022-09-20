<?php

declare(strict_types=1);

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\Exceptions\NotRoleException;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginRoleAuthenticationUseCase
{
    /**
     * @param LoginAuthenticationContract $loginAuthenticationContract
     */
    public function __construct(
        private LoginAuthenticationContract $loginAuthenticationContract
    )
    {
    }

    /**
     * @param string $jwt
     * @param string $typeRole
     * @return void
     * @throws NotRoleException
     */
    public function __invoke(string $jwt, string $typeRole): void
    {
        $login = new Login([
            "user" => $this->loginAuthenticationContract->get(new LoginJwt($jwt)),
            "typeRole" => $typeRole
        ]);
        $login->isUserCheckRole();
    }
}
