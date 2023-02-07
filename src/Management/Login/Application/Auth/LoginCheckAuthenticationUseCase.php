<?php

declare(strict_types=1);

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\Exceptions\AuthException;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginCheckAuthenticationUseCase
{
    /**
     * @param LoginAuthenticationContract $authentication
     */
    public function __construct(private LoginAuthenticationContract $authentication)
    {
    }

    /**
     * @param string $jwt
     * @return bool
     */
    public function __invoke(string $jwt): bool
    {
        return $this->authentication->check(new LoginJwt($jwt));
    }
}
