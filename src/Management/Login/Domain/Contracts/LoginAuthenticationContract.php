<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\Contracts;

use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;

interface LoginAuthenticationContract
{
    /**
     * @param LoginAuthentication $authentication
     * @return string
     */
    public function auth(LoginAuthentication $authentication): string;
}
