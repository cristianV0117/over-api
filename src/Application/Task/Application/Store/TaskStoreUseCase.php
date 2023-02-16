<?php

declare(strict_types=1);

namespace Src\Application\Task\Application\Store;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;
use Src\Shared\Domain\Events\EventBus;

final class TaskStoreUseCase
{
    /**
     * @param TaskRepositoryContract $taskRepositoryContract
     * @param EventBus $eventBus
     */
    public function __construct(
        private readonly TaskRepositoryContract $taskRepositoryContract,
        private readonly EventBus $eventBus
    )
    {
    }

    /**
     * @param array $request
     * @return Task
     */
    public function __invoke(array $request): Task
    {
        $task = $this->taskRepositoryContract->store(new TaskCriteria($request));
        $this->eventBus->publish($task->events()->event());
        return $task;
    }
}
