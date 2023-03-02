<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Criteria;

use Baethon\LaravelCriteria\CriteriaInterface;

final class CompareOrCriteria implements CriteriaInterface
{
    /**
     * @param string $field
     * @param string $operator
     * @param bool|int|string $value
     */
    public function __construct(
        private readonly string $field,
        private readonly string $operator,
        private readonly bool|int|string $value
    )
    {
    }

    /**
     * @param $query
     * @return void
     */
    public function apply($query): void
    {
        $query->orWhere($this->field, $this->operator, $this->value);
    }
}
