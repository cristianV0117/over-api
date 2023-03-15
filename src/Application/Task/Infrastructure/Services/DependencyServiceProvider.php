<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Services;

use Src\Application\Task\Application\Get\TaskIndexUseCase;
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
                    \Src\Application\Task\Application\Store\TaskStoreUseCase::class,
                    \Src\Application\Task\Application\Update\TaskCloseUseCase::class
                ],
                "contract" => \Src\Application\Task\Domain\Contracts\TaskRepositoryContract::class,
                "repository" => \Src\Application\Task\Infrastructure\Repositories\Eloquent\TaskRepository::class
            ],
            [
                "useCase" => [
                    \Src\Application\Task\Application\Store\TaskStoreUseCase::class,
                    \Src\Application\Task\Application\Update\TaskCloseUseCase::class
                ],
                "contract" => \Src\Shared\Domain\Events\EventBus::class,
                "repository" => \Src\Application\Task\Infrastructure\Events\TaskNotification::class
            ],
            [
                "useCase" => [
                    \Src\Application\Task\Application\Get\TaskIndexUseCase::class,
                ],
                "contract" => \Src\Application\Task\Domain\Contracts\TaskRepositoryContract::class,
                "repository" => \Src\Application\Task\Infrastructure\Repositories\Doctrine\TaskRepository::class
            ],
            // OUTPUT //
            [
                "useCase" => [
                    \Src\Application\Task\Infrastructure\Controllers\TaskIndexController::class,
                    \Src\Application\Task\Infrastructure\Controllers\TaskStoreController::class,
                    \Src\Application\Task\Infrastructure\Controllers\TaskCloseController::class
                ],
                "contract" => \Src\Shared\Infrastructure\Output\OutputFactory::class,
                "repository" => \Src\Shared\Infrastructure\Output\JsonOutput::class
            ]
        ]);
        parent::__construct($app);
    }
}
