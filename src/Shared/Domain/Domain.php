<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

abstract class Domain
{
    /**
     * @var mixed
     */
    protected mixed $events;

    /**
     * @param mixed $entity
     * @param string|null $event
     * @param string|null $exception
     */
    public function __construct(
        private readonly mixed $entity = null,
        private readonly ?string $event = null,
        private readonly ?string $exception = null

    )
    {
        $this->isException($this->exception);
        $this->domainEvent($this->event);
    }

    /**
     * @return mixed
     */
    public function entity(): mixed
    {
        return $this->entity;
    }

    /**
     * @return mixed
     */
    public function events(): mixed
    {
        return $this->events;
    }

    /**
     * @param string|null $exception
     * @return void
     */
    protected abstract function isException(?string $exception): void;

    /**
     * @param mixed $event
     * @return void
     */
    protected abstract function domainEvent(?string $event): void;
}
