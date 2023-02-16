<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Events;

abstract class DomainEvent
{
    /**
     * @param mixed $event
     */
    public function __construct(
        private readonly mixed $event
    )
    {
    }

    /**
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->event;
    }

    /**
     * @return mixed
     */
    public abstract function event(): mixed;
}
