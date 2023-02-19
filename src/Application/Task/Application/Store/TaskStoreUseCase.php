<?php

declare(strict_types=1);

namespace Src\Application\Task\Application\Store;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;
use Src\Management\Login\Application\Auth\LoginGetAuthenticationUseCase;
use Src\Shared\Domain\Events\EventBus;

final class TaskStoreUseCase
{
    /**
     * @param TaskRepositoryContract $taskRepositoryContract
     * @param EventBus $eventBus
     * @param LoginGetAuthenticationUseCase $loginCheckAuthenticationUseCase
     */
    public function __construct(
        private readonly TaskRepositoryContract $taskRepositoryContract,
        private readonly EventBus $eventBus,
        private readonly LoginGetAuthenticationUseCase $loginCheckAuthenticationUseCase
    )
    {
    }

    /**
     * @param array $request
     * @param string $jwt
     * @return Task
     */
    public function __invoke(array $request, string $jwt): Task
    {
        $task = $this->taskRepositoryContract->store(new TaskCriteria($request));
        $jwt = $this->loginCheckAuthenticationUseCase->__invoke($jwt);
        $jwt->user_task_id = $task->entity()["user_id"];
        $this->eventBus->publish($task->events()->event($jwt));
        return $task;
    }
}
