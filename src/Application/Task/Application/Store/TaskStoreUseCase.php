<?php

namespace Src\Application\Task\Application\Store;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;

final class TaskStoreUseCase
{
    public function __construct(private readonly TaskRepositoryContract $taskRepositoryContract)
    {
    }

    public function __invoke(array $request)
    {
        return $this->taskRepositoryContract->store(new TaskCriteria($request));
    }
}
