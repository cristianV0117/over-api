<?php

namespace Src\Application\Task\Infrastructure\Events;

use Src\Shared\Domain\Events\EventBus;

final class TaskNotification implements EventBus
{
    /**
     * @param mixed $eventElements
     * @return void
     */
    public function publish(mixed $eventElements): void
    {
        if (!empty($eventElements)) {
            event(new TaskNotificationBroadCast(
                $eventElements
            ));
        }
    }
}
