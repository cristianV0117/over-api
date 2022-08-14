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
     * @param LoginCriteria $login
     * @return Login
     */
    public function login(LoginCriteria $login): Login
    {
        $user = $this->userByEmailAndUserName($login->value()['email'], $login->value()['user_name']);

        if (empty($user)) {
            return new Login(null);
        }

        $check = $login->checkPassword($login->value()['password'], $user[0]['password']);

        if (!$check) {
            return new Login(null);
        }

        return new Login($user[0]);
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
        return $this->model->where('email', '=', $email)
            ->orWhere('user_name', '=', $userName)
            ->select('id', 'user_name', 'email', 'password')
            ->get()
            ->makeVisible('password')
            ->toArray();
    }
}
