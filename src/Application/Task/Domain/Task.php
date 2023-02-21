<?php

declare(strict_types=1);

namespace Src\Application\Task\Domain;

use Src\Application\Task\Domain\Events\TaskClose;
use Src\Application\Task\Domain\Events\TaskCreated;
use Src\Shared\Domain\Domain;

final class Task extends Domain
{
    private const TASK_CREATED = 'TASK_CREATED';
    private const TASK_CLOSE = 'TASK_CLOSE';

    /**
     * @param string|null $exception
     * @return void
     */
    protected function isException(?string $exception): void
    {
        // TODO: Implement isException() method.
    }

    /**
     * @param string|null $event
     * @return void
     */
    protected function domainEvent(?string $event): void
    {
        if ($event) {
            $this->events =  match ($event) {
                self::TASK_CREATED => new TaskCreated(),
                self::TASK_CLOSE => new TaskClose()
            };
        }
    }
}
