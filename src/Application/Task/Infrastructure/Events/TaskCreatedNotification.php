<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class TaskCreatedNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var mixed
     */
    public mixed $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn(): array|Channel
    {
        return ['NOTIFICATION_TO_WEBSOCKET'];
    }

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'TaskCreatedNotification';
    }
}
