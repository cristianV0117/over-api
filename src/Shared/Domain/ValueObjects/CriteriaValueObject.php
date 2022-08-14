<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObjects;

abstract class CriteriaValueObject
{
    /**
     * @var array|object
     */
    private array|object $value;

    /**
     * @param array|object $value
     */
    public function __construct(array|object $value)
    {
        $this->value = $value;
    }

    /**
     * @return array|object
     */
    public function value(): array|object
    {
        return $this->value;
    }
}
