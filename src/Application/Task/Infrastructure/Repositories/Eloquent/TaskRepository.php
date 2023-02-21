<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Repositories\Eloquent;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;
use Src\Application\Task\Domain\ValueObjects\TaskId;
use Src\Application\Task\Infrastructure\Repositories\Eloquent\Task as Model;
use Src\Application\Task\Infrastructure\Repositories\Eloquent\CategoryTask;
use Src\Shared\Infrastructure\Helper\DateHelper;

final class TaskRepository implements TaskRepositoryContract
{
    use DateHelper;

    public function __construct(
        private readonly Model $model,
        private readonly CategoryTask $categoryTask
    )
    {
    }

    /**
     * @param TaskCriteria $taskCriteria
     * @return Task
     */
    public function store(TaskCriteria $taskCriteria): Task
    {
        $handler = $taskCriteria->handler();
        $handler["categorie_task_id"] = $this->ifCategoryTaskExist($taskCriteria->value()["category_task"]) ?? 0;

        $store = $this->model->create($handler);

        return new Task($store->toArray(), 'TASK_CREATED');
    }

    /**
     * @param TaskId $taskId
     * @return Task
     */
    public function close(TaskId $taskId): Task
    {
        $task = $this->model->find($taskId->value());
        $task->closing_date = $this->now();
        $task->status = 2;
        $task->save();

        return new Task($task->id, 'TASK_CLOSE');
    }

    /**
     * @param array $categoryTask
     * @return int
     */
    private function ifCategoryTaskExist(array $categoryTask): int
    {
        $categoryTaskFind = $this->categoryTask->where('category', $categoryTask["category"])->get()->toArray();

        if (!$categoryTaskFind) {
            $categoryTaskCreated = $this->categoryTask->create($categoryTask);
            return $categoryTaskCreated->id;
        }

        return $categoryTaskFind[0]["id"] ?? 0;
    }
}
