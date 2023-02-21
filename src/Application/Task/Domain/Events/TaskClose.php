<?php

declare(strict_types=1);

namespace Src\Application\Task\Domain\Events;

use Src\Shared\Domain\Events\DomainEvent;

class TaskClose extends DomainEvent
{
    /**
     * @return string
     */
    private function eventName(): string
    {
        return 'task.close';
    }

    /**
     * @return string
     */
    private function eventDescription(): string
    {
        return 'Se ha cerrado la tarea';
    }

    /**
     * @return array|null
     */
    public function event(): ?array
    {
        $idUser = 1;

        if (1 !== $idUser) {
            return null;
        }

        return [
            'eventName' => $this->eventName(),
            'eventDescription' => $this->eventDescription()
        ];
    }
}
