<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Criteria;

use Baethon\LaravelCriteria\CriteriaInterface;

final class CompareOrCriteria implements CriteriaInterface
{
    /**
     * @param string $field
     * @param string $operator
     * @param string $value
     */
    public function __construct(
        private string $field,
        private string $operator,
        private string $value
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
