<?php

declare(strict_types=1);

namespace Src\Application\Task\Domain\Events;

use Src\Shared\Domain\Events\DomainEvent;

final class TaskCreated extends DomainEvent
{
    /**
     * @return string
     */
    private function eventName(): string
    {
        return 'task.created';
    }

    /**
     * @return string
     */
    private function eventDescription(): string
    {
        return 'Tienes una nueva tarea asignada';
    }

    /**
     * @param mixed $eventElements
     * @return array
     */
    public function event(mixed $eventElements): array
    {
        if ($eventElements->id !== $eventElements->user_task_id) {
            return [];
        }

        return [
            'eventUserId' => $eventElements->id,
            'eventName' => $this->eventName(),
            'eventDescription' => $this->eventDescription()
        ];
    }
}
