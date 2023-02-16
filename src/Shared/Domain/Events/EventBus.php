<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Events;

interface EventBus
{
    /**
     * @param mixed $eventElements
     * @return void
     */
    public function publish(mixed $eventElements): void;
}
