<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

abstract class Domain
{
    /**
     * @var mixed
     */
    private mixed $entity;

    /**
     * @param mixed $entity
     */
    public function __construct(mixed $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return mixed
     */
    public function entity(): mixed
    {
        return $this->entity;
    }
}
