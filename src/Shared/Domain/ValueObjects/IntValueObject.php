<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

abstract class IntValueObject
{
    /**
     * @param int $value
     */
    public function __construct(private int $value)
    {
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
