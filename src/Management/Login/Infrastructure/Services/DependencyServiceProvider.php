<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $this->setDependency([
            \Src\Management\Login\Application\Login\LoginAuthUseCase::class
        ],
            \Src\Management\Login\Domain\Contracts\LoginRepositoryContract::class,
            \Src\Management\Login\Infrastructure\Repositories\Eloquent\LoginRepository::class
        );
        parent::__construct($app);
    }
}

