<?php

namespace Src\Application\Role\Application\Get;

use Src\Application\Role\Domain\Contracts\RoleRepositoryContract;

final class RoleIndexUseCase
{
    public function __construct(private RoleRepositoryContract $roleRepositoryContract)
    {
    }

    public function __invoke()
    {
        return $this->roleRepositoryContract->index();
    }
}
