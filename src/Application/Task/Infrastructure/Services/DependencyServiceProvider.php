<?php

namespace Src\Application\Task\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;

final class DependencyServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $this->setDependency([
            [
                "useCase" => [
                    \Src\Application\Task\Application\Store\TaskStoreUseCase::class
                ],
                "contract" => \Src\Application\Task\Domain\Contracts\TaskRepositoryContract::class,
                "repository" => \Src\Application\Task\Infrastructure\Repositories\Eloquent\TaskRepository::class
            ]
        ]);
        parent::__construct($app);
    }
}
