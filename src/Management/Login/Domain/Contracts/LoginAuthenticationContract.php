<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\Contracts;

use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

interface LoginAuthenticationContract
{
    /**
     * @param LoginAuthentication $authentication
     * @return string
     */
    public function auth(LoginAuthentication $authentication): string;

    /**
     * @param LoginJwt $jwt
     * @return bool
     */
    public function check(LoginJwt $jwt): bool;

    /**
     * @param LoginJwt $jwt
     * @return array|string
     */
    public function get(LoginJwt $jwt): mixed;
}
