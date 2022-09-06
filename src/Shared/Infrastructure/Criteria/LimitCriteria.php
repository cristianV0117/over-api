<?php

namespace Src\Shared\Infrastructure\Criteria;

use Baethon\LaravelCriteria\CriteriaInterface;

class LimitCriteria implements CriteriaInterface
{
    /**
     * @param int $limit
     */
    public function __construct(
        private int $limit,
    )
    {
    }

    /**
     * @param $query
     * @return void
     */
    public function apply($query): void
    {
        $query->limit($this->limit);
    }
}
