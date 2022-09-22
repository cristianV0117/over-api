<?php

declare(strict_types=1);

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;

final class LoginAuthenticationUseCase
{
    /**
     * @param LoginAuthenticationContract $authentication
     */
    public function __construct(private LoginAuthenticationContract $authentication)
    {
    }

    /**
     * @param array $user
     * @return string
     */
    public function __invoke(array $user): string
    {
        return $this->authentication->auth(new LoginAuthentication($user));
    }
}
