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
            [
                "useCase" => [
                    \Src\Management\Login\Application\Login\LoginAuthUseCase::class
                ],
                "contract" => \Src\Management\Login\Domain\Contracts\LoginRepositoryContract::class,
                "repository" => \Src\Management\Login\Infrastructure\Repositories\Eloquent\LoginRepository::class
            ],
            [
                "useCase" => [
                    \Src\Management\Login\Application\Auth\LoginAuthenticationUseCase::class
                ],
                "contract" => \Src\Management\Login\Domain\Contracts\LoginAuthenticationContract::class,
                "repository" => \Src\Management\Login\Infrastructure\Authentication\Jwt\LoginAuthentication::class
            ]
        ]);
        parent::__construct($app);
    }
}

