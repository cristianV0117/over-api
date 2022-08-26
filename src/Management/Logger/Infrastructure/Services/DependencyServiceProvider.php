<?php

declare(strict_types=1);

namespace Src\Management\Logger\Infrastructure\Services;

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
                    \Src\Management\Logger\Application\Logger\LoggerLoginUseCase::class
                ],
                "contract" => \Src\Management\Logger\Domain\Contracts\LoggerRepositoryContract::class,
                "repository" => \Src\Management\Logger\Infrastructure\Repositories\Eloquent\LoggerRepository::class
            ],
            [
                "useCase" => [
                    \Src\Management\Logger\Infrastructure\Observers\LoggerLoginObserver::class
                ],
                "contract" => \Src\Shared\Infrastructure\Observers\Observable::class,
                "repository" => \Src\Management\Logger\Infrastructure\Observers\LoggerLoginSubject::class
            ]
        ]);
        parent::__construct($app);
    }
}

