<?php

namespace Src\Application\User\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserCriteria;
use Src\Application\User\Domain\ValueObjects\UserId;
use Src\Application\User\Domain\ValueObjects\UserStore;
use Src\Application\User\Domain\ValueObjects\UserUpdate;
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

    /**
     * @param UserId $id
     * @return User
     */
    public function show(UserId $id): User
    {
        $user = $this->model->find($id->value());
        return new User((null !== $user) ? $user->toArray() : null);
    }

    /**
     * @param UserStore $store
     * @return User
     */
    public function store(UserStore $store): User
    {
        $store = $this->model->create($store->handler());
        if (!$store) {
            return new User(null);
        }
        return new User($store->toArray());
    }

    /**
     * @param UserId $id
     * @param UserUpdate $update
     * @return User
     */
    public function update(UserId $id , UserUpdate $update): User
    {
        $record = $this->model->find($id->value());

        if (is_null($record)) {
            return $this->repositoryExceptions("User not found", 401);
        }

        return new User(($record->update($update->value())) ? [
            "id" => $record->id,
            "user_name" => $record->user_name,
            "email" => $record->email
        ] : null);
    }

    /**
     * @param UserId $id
     * @return User
     */
    public function destroy(UserId $id): User
    {
        $record = $this->model->find($id->value());

        if (is_null($record)) {
            return $this->repositoryExceptions("User not found", 401);
        }

        return new User(($record->delete()) ? [
            "id" => $record->id
        ]: null);
    }

    /**
     * @param string $message
     * @param int $status
     * @return User
     */
    private function repositoryExceptions(
        string $message,
        int $status
    ): User
    {
        $user = new User(null);
        $user->setException([
            "message" => $message,
            "code" => $status
        ]);
        return $user;
    }

    /**
     * @param UserCriteria $criteria
     * @return User
     */
    public function findByCriteria(UserCriteria $criteria): User
    {
        $query = $this->model::query();

        $query->apply($criteria->value());

        return new User($query->get()->toArray());
    }
}
