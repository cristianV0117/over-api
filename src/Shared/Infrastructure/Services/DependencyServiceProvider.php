<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

abstract class DependencyServiceProvider extends Service
{
    /**
     * @var array
     */
    private array $dependencies;

    /**
     * @param array $dependencies
     * @return void
     */
    public function setDependency(array $dependencies): void
    {
        $this->dependencies = $dependencies;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach ($this->dependencies as $value) {
            $this->app
                ->when($value["useCase"])
                ->needs($value["contract"])
                ->give($value["repository"]);
        }
    }
}
