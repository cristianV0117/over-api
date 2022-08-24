<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $this->setDependency([
            [
                "useCase" => [
                    \Src\Management\Forgot\Application\Mail\ForgotUserForgotPasswordUseCase::class
                ],
                "contract" => \Src\Management\Forgot\Domain\Contracts\ForgotMailableContract::class,
                "repository" => \Src\Management\Forgot\Infrastructure\Mail\Mail\ForgotMailable::class
            ]
        ]);
        parent::__construct($app);
    }
}

