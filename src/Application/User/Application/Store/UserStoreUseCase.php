<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Store;

use Src\Application\User\Application\Mail\UserCreatedUseCase;
use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\Events\UserCreatedEvent;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserStore;

final class UserStoreUseCase
{
    /**
     * @param UserRepositoryContract $repository
     * @param UserCreatedUseCase $userCreatedUseCase
     */
    public function __construct(
        private UserRepositoryContract $repository,
        private UserCreatedUseCase $userCreatedUseCase
    )
    {
    }

    /**
     * @param array $store
     * @return User
     */
    public function __invoke(array $store): User
    {
        $store = $this->repository->store(new UserStore($store));
        $this->userCreatedUseCase->__invoke((new UserCreatedEvent($store))->mailNotification());
        return $store;
    }
}
