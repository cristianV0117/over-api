<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Events;

abstract class DomainEvent
{
    /**
     * @param mixed $eventElements
     * @return mixed
     */
    public abstract function event(mixed $eventElements): mixed;
}
