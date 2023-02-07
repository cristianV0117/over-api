<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Repositories\Eloquent;

use Src\Management\Forgot\Domain\Contracts\ForgotRepositoryContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotReset;
use Src\Application\User\Infrastructure\Repositories\Eloquent\User as Model;

final class ForgotRepository implements ForgotRepositoryContract
{
    /**
     * @param Model $model
     */
    public function __construct(private readonly Model $model)
    {
    }

    /**
     * @param ForgotReset $reset
     * @return Forgot
     */
    public function reset(ForgotReset $reset): Forgot
    {
        $record = $this->model->where('email', $reset->value()["email"])->first();

        if (is_null($record)) {
            return new Forgot(null, 'USER_NOT_FOUND');
        }

        return ($record->update($reset->handler())) ? new Forgot([
            "id" => $record->id,
            "user_name" => $record->user_name,
            "email" => $record->email
        ]) : new Forgot(null, 'UPDATE_PASSWORD_USER_FAILED');
    }
}
