<?php

declare(strict_types=1);

namespace Src\Application\Task\Application\Store;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;

final class TaskStoreUseCase
{
    /**
     * @param TaskRepositoryContract $taskRepositoryContract
     */
    public function __construct(private readonly TaskRepositoryContract $taskRepositoryContract)
    {
    }

    /**
     * @param array $request
     * @return Task
     */
    public function __invoke(array $request): Task
    {
        return $this->taskRepositoryContract->store(new TaskCriteria($request));
    }
}
