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
     * @return array
     */
    public function event(): array
    {
        return [
            'eventName' => $this->eventName(),
            'eventDescription' => $this->eventDescription()
        ];
    }
}
