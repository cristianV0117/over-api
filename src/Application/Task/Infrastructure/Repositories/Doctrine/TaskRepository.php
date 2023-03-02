<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Repositories\Doctrine;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Exception\NotSupported;
use Src\Application\Task\Domain\Contracts\TaskRepositoryContract;
use Src\Application\Task\Domain\Task;
use Src\Application\Task\Domain\ValueObjects\TaskCriteria;
use Src\Application\Task\Domain\ValueObjects\TaskId;

use \Src\Application\Task\Infrastructure\Repositories\Doctrine\Task as Entity;
use Doctrine\ORM\EntityManager;

final class TaskRepository implements TaskRepositoryContract
{
    public function __construct(
        private readonly Entity $entity,
        private readonly EntityManager $entityManager
    )
    {
    }

    /**
     * @return Task
     * @throws NotSupported
     */
    public function index(): Task
    {
        $repository = $this->entityManager
            ->getRepository($this->entity::class)
            ->createQueryBuilder('c')
            ->getQuery();
        return new Task($repository->getResult(AbstractQuery::HYDRATE_ARRAY));
    }

    public function store(TaskCriteria $taskCriteria): Task
    {
        return new Task();
    }

    public function close(TaskId $taskId): Task
    {
        return new Task();
    }
}
