<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\Contracts;

use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginCriteria;

interface LoginRepositoryContract
{
    /**
     * @param LoginCriteria $login
     * @return Login
     */
    public function login(LoginCriteria $login): Login;
}
