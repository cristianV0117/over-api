<?php

namespace Src\Application\Role\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $this->setDependency([
            [
                "useCase" => [
                    \Src\Application\Role\Application\Get\RoleIndexUseCase::class
                ],
                "contract" => \Src\Application\Role\Domain\Contracts\RoleRepositoryContract::class,
                "repository" => \Src\Application\Role\Infrastructure\Repositories\Eloquent\RoleRepository::class
            ]
        ]);
        parent::__construct($app);
    }
}
