<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Infrastructure\Repositories\Eloquent\User as Model;
use Src\Management\Logger\Infrastructure\Observers\LoggerLoginObserver;
use Src\Management\Logger\Infrastructure\Observers\LoggerLoginSubject;
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
     * @var LoggerLoginSubject
     */
    private LoggerLoginSubject $subject;

    /**
     * @param Model $model
     * @param LoggerLoginSubject $subject
     * @param LoggerLoginObserver $observer
     */
    public function __construct(Model $model, LoggerLoginSubject $subject, LoggerLoginObserver $observer)
    {
        $this->model = $model;
        $this->subject = $subject;
        $this->subject->attach($observer);
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

        $this->subject->notifyUserLogin([
            "user_id" => $user[0]["id"],
            "type" => 1
        ]);
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
