<?php

declare(strict_types=1);

namespace Src\Application\Task\Application\Get;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;

final class TaskIndexUseCase
{
    /**
     * @param TaskRepositoryContract $taskRepositoryContract
     */
    public function __construct(
        private readonly TaskRepositoryContract $taskRepositoryContract
    )
    {
    }

    /**
     * @return Task
     */
    public function __invoke(): Task
    {
        return $this->taskRepositoryContract->index();
    }
}
