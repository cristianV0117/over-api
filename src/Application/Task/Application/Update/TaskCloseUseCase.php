<?php

namespace Src\Application\Task\Application\Update;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskId;

final class TaskCloseUseCase
{
    /**
     * @param TaskRepositoryContract $taskRepositoryContract
     */
    public function __construct(private readonly TaskRepositoryContract $taskRepositoryContract)
    {
    }

    /**
     * @param int $id
     * @return Task
     */
    public function __invoke(int $id): Task
    {
        return $this->taskRepositoryContract->close(new TaskId($id));
    }
}
