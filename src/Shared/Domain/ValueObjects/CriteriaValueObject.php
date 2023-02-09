<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

abstract class CriteriaValueObject
{
    /**
     * @param mixed $value
     */
    public function __construct(private readonly mixed $value)
    {
    }

    /**
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->value;
    }
}
