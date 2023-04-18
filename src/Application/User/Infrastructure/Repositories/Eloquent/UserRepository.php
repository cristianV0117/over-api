<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Application\User\Domain\ValueObjects\{UserCriteria, UserId, UserStore, UserStoreImportCriteria, UserUpdate};
use Src\Application\User\Infrastructure\Repositories\Eloquent\User as Model;

final class UserRepository implements UserRepositoryContract
{
    use HttpCodesHelper;

    /**
     * @param Model $model
     */
    public function __construct(private readonly Model $model)
    {
    }

    /**
     * @return User
     */
    public function index(): User
    {
        return new User(entity:  $this->model->all()->toArray());
    }

    /**
     * @param UserId $id
     * @return User
     */
    public function show(UserId $id): User
    {
        $user = $this->model->find($id->value());

        return ($user) ? new User(entity: $user->toArray()) : new User(exception: "USER_NOT_FOUND");
    }

    /**
     * @param UserStore $store
     * @return User
     */
    public function store(UserStore $store): User
    {
        $store = $this->model->create($store->handler());

        return ($store) ? new User(entity: $store->toArray()) : new User(exception: 'USER_STORE_FAILED');
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
            return (new User(exception: "USER_NOT_FOUND"));
        }

        return ($record->update($update->handler())) ? new User(entity: [
            "id" => $record->id,
            "user_name" => $record->user_name,
            "email" => $record->email
        ]) : new User(exception: 'USER_UPDATED_FAILED');
    }

    /**
     * @param UserId $id
     * @return User
     */
    public function destroy(UserId $id): User
    {
        $record = $this->model->find($id->value());

        if (is_null($record)) {
            return new User(exception: 'USER_NOT_FOUND');
        }

        return ($record->delete()) ? new User(entity: [
            "id" => $record->id
        ]) : new User(exception: 'USER_DESTROY_FAILED');
    }

    /**
     * @param UserCriteria $criteria
     * @return User
     */
    public function match(UserCriteria $criteria): User
    {
        $query = $this->model::query();

        $query->apply($criteria->value());

        return new User(entity: $query->get()->toArray());
    }

    public function storeImport(UserStoreImportCriteria $userStoreImport): User
    {
        dd($userStoreImport->value());
    }
}
