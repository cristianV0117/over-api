<?php

declare(strict_types=1);

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\Exceptions\AuthException;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginCheckAuthenticationUseCase
{
    /**
     * @var LoginAuthenticationContract
     */
    private LoginAuthenticationContract $authentication;

    /**
     * @param LoginAuthenticationContract $authentication
     */
    public function __construct(LoginAuthenticationContract $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @param string $jwt
     * @return bool
     * @throws AuthException
     */
    public function __invoke(string $jwt): bool
    {
        $auth = $this->authentication->check(new LoginJwt($jwt));
        $this->authStatus($auth);
        return $auth;
    }

    /**
     * @param bool $auth
     * @throws AuthException
     */
    private function authStatus(bool $auth): void
    {
        if (!$auth) {
            throw new AuthException("invalid token or invalid user", 401);
        }
    }

}
