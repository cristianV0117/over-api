<?php

declare(strict_types=1);

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Management\Login\Domain\Exceptions\NotRoleException;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginRoleAuthenticationUseCase
{
    /**
     * @param LoginAuthenticationContract $loginAuthenticationContract
     */
    public function __construct(
        private readonly LoginAuthenticationContract $loginAuthenticationContract
    )
    {
    }

    /**
     * @param string $jwt
     * @param string|array $typeRole
     * @return void
     * @throws NotRoleException
     * @throws NotLoginException
     */
    public function __invoke(string $jwt, string|array $typeRole): void
    {
        new Login([
            "user" => $this->loginAuthenticationContract->get(new LoginJwt($jwt)),
            "typeRoles" => $typeRole
        ]);
    }
}
