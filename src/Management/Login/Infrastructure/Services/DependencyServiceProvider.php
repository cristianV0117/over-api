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
                    \Src\Management\Login\Application\Auth\LoginAuthenticationUseCase::class,
                    \Src\Management\Login\Application\Auth\LoginCheckAuthenticationUseCase::class,
                    \Src\Management\Login\Application\Auth\LoginRoleAuthenticationUseCase::class,
                    \Src\Management\Login\Application\Auth\LoginGetAuthenticationUseCase::class
                ],
                "contract" => \Src\Management\Login\Domain\Contracts\LoginAuthenticationContract::class,
                "repository" => \Src\Management\Login\Infrastructure\Repositories\Jwt\LoginAuthentication::class
            ],
            [
                "useCase" => \Src\Management\Login\Infrastructure\Controllers\LoginAuthController::class,
                "contract" => \Src\Shared\Infrastructure\Responses\ResponseFactory::class,
                "repository" => \Src\Shared\Infrastructure\Responses\JsonResponse::class
            ]
        ]);
        parent::__construct($app);
    }
}

