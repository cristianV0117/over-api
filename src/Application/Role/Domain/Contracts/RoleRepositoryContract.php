<?php

declare(strict_types=1);

namespace Src\Application\Role\Domain\Contracts;

use Src\Application\Role\Domain\Role;

interface RoleRepositoryContract
{
    public function index(): Role;
}
