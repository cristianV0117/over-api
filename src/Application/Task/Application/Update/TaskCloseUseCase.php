<?php

declare(strict_types=1);

namespace Src\Application\Task\Application\Update;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskId;
use Src\Shared\Domain\Events\EventBus;

final class TaskCloseUseCase
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
     * @param int $id
     * @return Task
     */
    public function __invoke(int $id): Task
    {
        $task = $this->taskRepositoryContract->close(new TaskId($id));
        $this->eventBus->publish($task->events()->event(null));
        return $task;
    }
}
