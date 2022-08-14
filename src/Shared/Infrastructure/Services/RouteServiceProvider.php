<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

abstract class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var mixed
     */
    private mixed $prefix;
    /**
     * @var mixed
     */
    protected $namespace;
    /**
     * @var mixed
     */
    private mixed $group;
    /**
     * @var bool|null
     */
    private ?bool $except;

    /**
     * @param mixed $prefix
     * @param mixed $namespace
     * @param mixed $group
     * @param bool|null $except
     * @return void
     */
    public function setDependency(
        mixed $prefix,
        mixed $namespace,
        mixed $group,
        ?bool $except = null
    ): void
    {
        $this->prefix = $prefix;
        $this->namespace = $namespace;
        $this->group = $group;
        $this->except = $except;
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * @return void
     */
    public function map(): void
    {
        $this->mapRoutes();
    }

    /**
     * @return void
     */
    public function mapRoutes(): void
    {
        if ($this->except) {
            Route::middleware('api')
                ->prefix($this->prefix)
                ->namespace($this->namespace)
                ->group(base_path($this->group));
        } else {
            Route::middleware(['api', 'jwt'])
                ->prefix($this->prefix)
                ->namespace($this->namespace)
                ->group(base_path($this->group));
        }
    }
}
