<?php

namespace Src\Shared\Infrastructure\Repositories\Criteria;

use Closure;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class Criteria
{
    /** @var string $table */
    protected string $table;

    /** @var array $param */
    protected array $param = [];

    /** @var array $original */
    protected array $original = [];

    /** @var array $criteria */
    protected array $criteria = [];

    /** @var string $prefixMethod */
    protected string $prefixMethod = 'criteria';

    /**
     * Criteria constructor.
     *
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        $param = $param ?: request()->query();
        $this->setOriginal($param);
        $this->setParam($param);
    }

    /**
     * @param array $param
     */
    public function setOriginal(array $param): void
    {
        $this->original = $param;
    }

    /**
     * @param array $param
     */
    public function setParam(array $param): void
    {
        $this->param = collect($param)
            ->transform($this->transformParam())
            ->filter($this->filterParam())
            ->filter($this->filterCriteria())
            ->toArray();
    }

    /**
     * @return Closure
     */
    protected function transformParam(): Closure
    {
        return function ($value) {
            if (is_array($value)) {
                $value = collect($value)->filter(
                    function ($value) {
                        return $value !== null;
                    }
                )
                    ->toArray();
            }

            return $value;
        };
    }

    /**
     * @return Closure
     */
    protected function filterParam(): Closure
    {
        return function ($value) {
            if (is_object($value)) {
                return false;
            }

            return is_array($value) ? !empty($value) : $value !== null;
        };
    }

    /**
     * @return Closure
     */
    protected function filterCriteria(): Closure
    {
        return function ($value, $key) {
            $criteria = $this->getCriteria();

            return in_array($key, $criteria) || key_exists($key, $criteria);
        };
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder|Builder $query
     */
    public function apply(\Illuminate\Database\Eloquent\Builder|Builder $query): void
    {
        $this->setTable($query);
        foreach ($this->param as $key => $value) {
            if ($this->customMethod($query, $key, $value)) {
                continue;
            }
            $this->basicCriteria($query, $key, $value);
        }
    }

    /**
     * @param $query
     */
    protected function setTable($query): void
    {
        $this->table = DB::getTablePrefix();
        if ($query instanceof \Illuminate\Database\Eloquent\Builder) {
            $this->table .= $query->getModel()->getTable();
        } elseif ($query instanceof Builder) {
            $this->table .= $query->from;
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder|Builder $query
     * @param $key
     * @param $value
     * @return bool
     */
    protected function customMethod(\Illuminate\Database\Eloquent\Builder|Builder $query, $key, $value): bool
    {
        $method = $this->prefixMethod . Str::studly($key);
        if (method_exists($this, $method)) {
            $this->{$method}($query, $value);

            return true;
        }

        return false;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder|Builder $query
     * @param $key
     * @param $value
     */
    protected function basicCriteria(\Illuminate\Database\Eloquent\Builder|Builder $query, $key, $value): void
    {
        $criteria = $this->getCriteria();

        if (in_array($key, $criteria)) {
            $value = is_array($value) ? $value : [$value];
            $query->whereIn($this->getTable() . '.' . $key, $value);

            return;
        }

        if (key_exists($key, $criteria) && Str::lower($criteria[$key]) === 'like') {
            $query->where($this->getTable() . '.' . $key, 'like', "%$value%");

            return;
        }
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return array
     */
    public function getParam(): array
    {
        return $this->param;
    }

    /**
     * @return array
     */
    public function getCriteria(): array
    {
        return $this->criteria;
    }
}
