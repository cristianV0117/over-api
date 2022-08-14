<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Services;

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
                    \Src\Application\User\Application\Get\UserIndexUseCase::class,
                    \Src\Application\User\Application\Get\UserShowUseCase::class
                ],
                "contract" => \Src\Application\User\Domain\Contracts\UserRepositoryContract::class,
                "repository" => \Src\Application\User\Infrastructure\Repositories\Eloquent\UserRepository::class
            ]
        ]);
        parent::__construct($app);
    }
}

