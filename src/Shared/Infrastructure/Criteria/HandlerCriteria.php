<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Criteria;

use Baethon\LaravelCriteria\Collection\AllOfCriteriaCollection;
use Baethon\LaravelCriteria\Collection\CriteriaCollection;

final class HandlerCriteria
{
    private const FILTERS = 'filters';
    private const LIMIT = 'limit';
    private const CONTAINS = 'contains';
    private const EQUAL = '=';
    private array $criteria = [];

    public function __construct(private array $handlerCriteria)
    {
        $this->handlerCriteria();
    }

    /**
     * @return CriteriaCollection
     */
    public function criteria(): CriteriaCollection
    {
        return CriteriaCollection::create($this->criteria);
    }

    private function handlerCriteria(): void
    {
        if ($this->handlerCriteria[self::FILTERS]) {
            array_map(function ($filter, $key) {
                if (0 === $key) {
                    $this->criteria = array_merge($this->criteria, [
                        new CompareCriteria(
                            $filter["field"],
                            $filter["operator"],
                            $filter["value"]
                        )
                    ]);
                } else {
                    $this->criteria = array_merge($this->criteria, [
                        new CompareOrCriteria(
                            $filter["field"],
                            $filter["operator"],
                            $filter["value"]
                        )
                    ]);
                }
            }, $this->handlerCriteria[self::FILTERS], array_keys($this->handlerCriteria[self::FILTERS]));
        }

        if ($this->handlerCriteria[self::LIMIT]) {
            $this->criteria = array_merge($this->criteria, [
                new LimitCriteria($this->handlerCriteria[self::LIMIT])
            ]);
        }
    }
}
