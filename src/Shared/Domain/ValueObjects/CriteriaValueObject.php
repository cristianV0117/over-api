<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

abstract class CriteriaValueObject
{
    /**
     * @var mixed
     */
    private mixed $value;

    /**
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->value;
    }
}
