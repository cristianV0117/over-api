<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Domain\Exceptions\UserNotFoundException;
use Src\Management\Forgot\Domain\Contracts\ForgotRepositoryContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotReset;
use Src\Application\User\Infrastructure\Repositories\Eloquent\User as Model;

final class ForgotRepository implements ForgotRepositoryContract
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
     * @param ForgotReset $reset
     * @return Forgot
     * @throws UserNotFoundException
     */
    public function reset(ForgotReset $reset): Forgot
    {
        $record = $this->model->where('email', $reset->value()["email"])->first();

        if (is_null($record)) {
            throw new UserNotFoundException("User not found", 404);
        }

        return new Forgot(($record->update($reset->handler())) ? [
            "id" => $record->id,
            "user_name" => $record->user_name,
            "email" => $record->email
        ] : null);
    }
}
