<?php

namespace Src\Shared\Infrastructure\Repositories\Criteria;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

class SortOptions
{
    /** @var string[] $sorts */
    protected array $sorts = [
        'id',
        'updated_at',
    ];

    /** @var array $param */
    protected array $param = [];

    /** @var string[][] $default */
    protected array $default = [
        ['updated_at', 'desc'],
        ['id', 'desc'],
    ];

    /** @var string $sortName */
    protected string $sortName = 'sort';

    public function __construct(array $param = [])
    {
        $param = $param ?: request()->query();
        $this->setParam($param);
    }

    /**
     * @param array $param
     */
    protected function setParam(array $param): void
    {
        if (empty($param[$this->sortName]) || !is_string($param[$this->sortName])) {
            $this->param = $this->default;

            return;
        }

        $sorts = explode(',', $param[$this->sortName]);

        $this->param = collect($sorts)->map(function ($string) {
            $first = Str::substr($string, 0, 1);

            if ($first === '-') {
                return [Str::substr($string, 1), 'desc'];
            }

            return [$string, 'asc'];
        })
            ->filter(function ($sort) {
                return in_array($sort[0], $this->sorts);
            })
            ->toArray();

        // set default if param still empty
        if (empty($this->param)) {
            $this->param = $this->default;

            return;
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder|Builder $query
     */
    public function apply(\Illuminate\Database\Eloquent\Builder|Builder $query): void
    {
        foreach ($this->param as $sort) {
            $query->orderBy($sort[0], $sort[1]);
        }
    }
}
