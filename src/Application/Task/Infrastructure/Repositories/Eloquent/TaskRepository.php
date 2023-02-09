<?php

namespace Src\Application\Task\Infrastructure\Repositories\Eloquent;

use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;
use Src\Application\Task\Infrastructure\Repositories\Eloquent\Task as Model;
use Src\Application\Task\Infrastructure\Repositories\Eloquent\CategoryTask;

final class TaskRepository implements TaskRepositoryContract
{
    /**
     * @param \Src\Application\Task\Infrastructure\Repositories\Eloquent\Task $model
     * @param \Src\Application\Task\Infrastructure\Repositories\Eloquent\CategoryTask $categoryTask
     */
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
        $idCategoryTask = $this->ifCategoryTaskExist($taskCriteria->value()["category_task"]);
        $handler["categorie_task_id"] = $idCategoryTask ?? 0;

        $store = $this->model->create($handler);

        return new Task($store->toArray());
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
