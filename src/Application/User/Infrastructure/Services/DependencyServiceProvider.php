<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;

final class DependencyServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $this->setDependency([
            [
                "useCase" => [
                    \Src\Application\User\Application\Get\UserIndexUseCase::class,
                    \Src\Application\User\Application\Get\UserShowUseCase::class,
                    \Src\Application\User\Application\Store\UserStoreUseCase::class,
                    \Src\Application\User\Application\Destroy\UserDestroyUseCase::class,
                    \Src\Application\User\Application\Update\UserUpdateUseCase::class,
                    \Src\Application\User\Application\Get\UserCriteriaUseCase::class
                ],
                "contract" => \Src\Application\User\Domain\Contracts\UserRepositoryContract::class,
                "repository" => \Src\Application\User\Infrastructure\Repositories\Eloquent\UserRepository::class
            ],
            [
                "useCase" => [
                    \Src\Application\User\Application\Mail\UserCreatedUseCase::class
                ],
                "contract" => \Src\Application\User\Domain\Contracts\UserMailContract::class,
                "repository" => \Src\Application\User\Infrastructure\Repositories\Mail\UserMail::class
            ],
            // OUTPUT //
            [
                "useCase" => [
                    \Src\Application\User\Infrastructure\Controllers\UserShowController::class,
                    \Src\Application\User\Infrastructure\Controllers\UserIndexController::class
                ],
                "contract" => \Src\Shared\Infrastructure\Responses\ResponseFactory::class,
                "repository" => \Src\Shared\Infrastructure\Responses\JsonResponse::class
            ]
        ]);
        parent::__construct($app);
    }
}

