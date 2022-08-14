<?php

namespace Src\Application\User\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Infrastructure\Repositories\Eloquent\User as Model;

class UserRepository implements UserRepositoryContract
{
    /**
     * @var Model
     */
    private Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return User
     */
    public function index(): User
    {
        return new User($this->model->all()->toArray());
    }
}
