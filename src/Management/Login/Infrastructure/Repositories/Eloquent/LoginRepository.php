<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Infrastructure\Repositories\Eloquent\User as Model;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginCriteria;

final class LoginRepository implements LoginRepositoryContract
{
    /**
     * @param Model $model
     */
    public function __construct(private readonly Model $model)
    {
    }

    /**
     * @param LoginCriteria $login
     * @return Login
     */
    public function login(LoginCriteria $login): Login
    {
        $user = $this->userByEmailAndUserName($login->value()['email'], $login->value()['user_name']);

        if (empty($user)) {
            return new Login(null, 'USER_OR_PASSWORD_INCORRECT');
        }

        $check = $login->checkPassword($login->value()['password'], $user['password']);

        if (!$check) {
            return new Login(null, 'USER_OR_PASSWORD_INCORRECT');
        }

        return new Login($user);
    }

    /**
     * @param string $email
     * @param string $userName
     * @return array|null
     */
    private function userByEmailAndUserName(
        string $email,
        string $userName
    ): ?array
    {
        $user = $this->model
            ->with('roles')
            ->where('email', '=', $email)
            ->orWhere('user_name', '=', $userName)
            ->select(
                'id',
                'user_name',
                'email',
                'password',
            )
            ->first();

        return $user?->makeVisible('password')
            ->toArray();
    }
}
