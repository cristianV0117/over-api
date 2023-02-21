<?php

declare(strict_types=1);

namespace Src\Application\Role\Application\Get;

use Src\Application\Role\Domain\Contracts\RoleRepositoryContract;
use Src\Application\Role\Domain\Role;

final class RoleIndexUseCase
{
    /**
     * @param RoleRepositoryContract $roleRepositoryContract
     */
    public function __construct(private readonly RoleRepositoryContract $roleRepositoryContract)
    {
    }

    /**
     * @return Role
     */
    public function __invoke(): Role
    {
        return $this->roleRepositoryContract->index();
    }
}
