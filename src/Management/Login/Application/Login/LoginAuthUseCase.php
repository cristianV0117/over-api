<?php

declare(strict_types=1);

namespace Src\Management\Login\Application\Login;

use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginCriteria;

final class LoginAuthUseCase
{
    /**
     * @var LoginRepositoryContract
     */
    private LoginRepositoryContract $repository;

    /**
     * @param LoginRepositoryContract $repository
     */
    public function __construct(LoginRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $criteria
     * @return Login
     * @throws NotLoginException
     */
    public function __invoke(array $criteria): Login
    {
        $login = $this->repository->login(new LoginCriteria($criteria));
        $this->loginStatus($login);
        return $login;
    }

    /**
     * @param Login $login
     * @return void
     * @throws NotLoginException
     */
    private function loginStatus(Login $login): void
    {
        if (is_null($login->entity())) {
            throw new NotLoginException('email, user name or password incorrect', 401);
        }
    }
}
