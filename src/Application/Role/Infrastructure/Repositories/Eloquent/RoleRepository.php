<?php

namespace Src\Application\Role\Infrastructure\Repositories\Eloquent;

use Src\Application\Role\Domain\Contracts\RoleRepositoryContract;
use Src\Application\Role\Domain\Role;
use Src\Application\Role\Infrastructure\Repositories\Eloquent\Role as Model;

class RoleRepository implements RoleRepositoryContract
{
    public function __construct(private Model $model)
    {
    }

    public function index(): Role
    {
        return new Role($this->model->all()->toArray());
    }
}
