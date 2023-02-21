<?php

declare(strict_types=1);

namespace Src\Application\Task\Domain\Contracts;

use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;
use Src\Application\Task\Domain\ValueObjects\TaskId;

interface TaskRepositoryContract
{
    /**
     * @param TaskCriteria $taskCriteria
     * @return Task
     */
    public function store(TaskCriteria $taskCriteria): Task;

    /**
     * @param TaskId $taskId
     * @return Task
     */
    public function close(TaskId $taskId): Task;
}
