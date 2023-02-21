<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Repositories\Jwt;

use Exception;
use Firebase\JWT\JWT;
use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication as LoginAuthenticationCriteria;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

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
            [
                $authentication->handler()
            ],
            $authentication->private()
        );
    }

    /**
     * @param LoginJwt $jwt
     * @return bool
     */
    public function check(LoginJwt $jwt): bool
    {
        try {
            $decode = $this->jwt::decode(
                $jwt->value(),
                $jwt->secret(),
                $jwt->encrypt()
            );
            if (time() > $decode[0]->exp) {
                return false;
            }
        } catch (Exception) {
            return false;
        }

        return true;
    }

    /**
     * @param LoginJwt $jwt
     * @return string
     */
    public function get(LoginJwt $jwt): mixed
    {
        return $this->jwt::decode(
            $jwt->value(),
            $jwt->secret(),
            $jwt->encrypt()
        )[0]->data;
    }
}
