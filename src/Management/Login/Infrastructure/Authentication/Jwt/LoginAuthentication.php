<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Authentication\Jwt;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication as LoginAuthenticationCriteria;
use Firebase\JWT\JWT;

final class LoginAuthentication implements LoginAuthenticationContract
{
    /**
     * @var JWT
     */
    private JWT $jwt;

    public function __construct()
    {
        $this->jwt = new JWT();
    }

    /**
     * @param LoginAuthenticationCriteria $authentication
     * @return string
     */
    public function auth(LoginAuthenticationCriteria $authentication): string
    {
        return $this->jwt::encode(
            $authentication->handler(),
            $authentication->private()
        );
    }
}
