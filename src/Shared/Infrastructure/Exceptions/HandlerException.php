<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Exceptions;

use Illuminate\Foundation\Exceptions\Handler;
use Src\Shared\Domain\Exceptions\CustomException;
use Throwable;

class HandlerException extends Handler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e) {
            if ($e instanceof CustomException) {
                return response()->json($e->toException(), $e->getCode());
            }
        });
    }
}
