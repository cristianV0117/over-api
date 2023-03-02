<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Criteria;

use Baethon\LaravelCriteria\Collection\CriteriaCollection;
use Illuminate\Support\Collection;

final class HandlerCriteria
{
    private const FILTERS = 'filters';
    private const LIMIT = 'limit';
    /**
     * @var array
     */
    private array $criteria = [];

    /**
     * @var string
     */
    private string $criteriaNameSpace = 'Src\Shared\Infrastructure\Criteria\\';

    /**
     * @param array $handlerCriteria
     */
    public function __construct(private readonly array $handlerCriteria)
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

    /**
     * @return void
     */
    private function handlerCriteria(): void
    {
        $criteria = $this->getHandlerCriteria();
        $criteria->map(function (array $filters) {
            $reflectionClass = $this->criteriaNameSpace . $filters["type"];
            $this->criteria = array_merge($this->criteria, [
                new $reflectionClass(
                    $filters["field"],
                    $filters["operator"],
                    $filters["value"]
                )
            ]);
        });

        if ($this->handlerCriteria[self::LIMIT]) {
            $this->criteria = array_merge($this->criteria, [
                new LimitCriteria($this->handlerCriteria[self::LIMIT])
            ]);
        }
    }

    /**
     * @return Collection
     */
    private function getHandlerCriteria(): Collection
    {
        return collect($this->handlerCriteria[self::FILTERS]);
    }
}
