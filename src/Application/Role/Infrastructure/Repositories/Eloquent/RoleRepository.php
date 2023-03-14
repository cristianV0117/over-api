<?php

declare(strict_types=1);

namespace Src\Application\Role\Infrastructure\Repositories\Eloquent;

use Src\Application\Role\Domain\Contracts\RoleRepositoryContract;
use Src\Application\Role\Domain\Role;
use Src\Application\Role\Infrastructure\Repositories\Eloquent\Role as Model;

class RoleRepository implements RoleRepositoryContract
{
    /**
     * @param \Src\Application\Role\Infrastructure\Repositories\Eloquent\Role $model
     */
    public function __construct(private readonly Model $model)
    {
    }

    /**
     * @return Role
     */
    public function index(): Role
    {
        return new Role(entity: $this->model->all()->toArray());
    }
}
