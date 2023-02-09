<?php

namespace Src\Application\Task\Domain\Contracts;

use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;

interface TaskRepositoryContract
{
    /**
     * @param TaskCriteria $taskCriteria
     * @return Task
     */
    public function store(TaskCriteria $taskCriteria): Task;
}
