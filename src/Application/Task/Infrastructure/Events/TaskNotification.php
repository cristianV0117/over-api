<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Events;

use Src\Shared\Domain\Events\EventBus;
use Src\Shared\Infrastructure\Repositories\Eloquent\Notification;

final class TaskNotification implements EventBus
{
    public function __construct(private Notification $notification)
    {
    }

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

    private function saveNotification(mixed $eventElements)
    {
        $this->notification->create([

        ]);
    }
}
