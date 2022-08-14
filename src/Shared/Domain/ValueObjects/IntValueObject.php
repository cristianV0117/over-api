<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

abstract class IntValueObject
{
    /**
     * @var int
     */
    private int $value;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
