<?php

declare(strict_types=1);

namespace Src\Application\User\Domain\Contracts;

use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;
use Src\Application\User\Domain\ValueObjects\UserStore;

interface UserRepositoryContract
{
    /**
     * @return User
     */
    public function index(): User;

    /**
     * @param UserId $id
     * @return User
     */
    public function show(UserId $id): User;

    /**
     * @param UserStore $store
     * @return User
     */
    public function store(UserStore $store): User;
}
