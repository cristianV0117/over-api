<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

abstract class DependencyServiceProvider extends Service
{
    /**
     * @var mixed
     */
    private mixed $useCase;
    /**
     * @var mixed
     */
    private mixed $contract;
    /**
     * @var mixed
     */
    private mixed $repository;

    public function setDependency($useCase, $contract, $repository): void
    {
        $this->useCase = $useCase;
        $this->contract = $contract;
        $this->repository = $repository;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app
            ->when($this->useCase)
            ->needs($this->contract)
            ->give($this->repository);
    }
}
