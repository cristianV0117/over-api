<?php

declare(strict_types=1);

namespace Src\Application\User\Domain\Contracts;

use Src\Application\User\Domain\User;

interface UserRepositoryContract
{
    /**
     * @return User
     */
    public function index(): User;
}
