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
                    \Src\Application\User\Application\Get\UserCriteriaUseCase::class,
                    \Src\Application\User\Application\Store\UserStoreImportUseCase::class
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
                    \Src\Application\User\Infrastructure\Controllers\UserDestroyController::class,
                    \Src\Application\User\Infrastructure\Controllers\UserStoreController::class,
                    \Src\Application\User\Infrastructure\Controllers\UserUpdateController::class,
                    \Src\Application\User\Infrastructure\Controllers\UserCriteriaController::class,
                    \Src\Application\User\Infrastructure\Controllers\UserImportController::class
                ],
                "contract" => \Src\Shared\Infrastructure\Output\OutputFactory::class,
                "repository" => \Src\Shared\Infrastructure\Output\JsonOutput::class
            ],
            [
                "useCase" => \Src\Application\User\Infrastructure\Controllers\UserIndexController::class,
                "contract" => \Src\Shared\Infrastructure\Output\OutputFactory::class,
                "repository" => \Src\Shared\Infrastructure\Output\JsonOutput::class
            ],
            [
                "useCase" => \Src\Application\User\Application\Import\UserImportUseCase::class,
                "contract" => \Src\Application\User\Domain\Contracts\UserImportContract::class,
                "repository" => \Src\Application\User\Infrastructure\Repositories\Import\UserImport::class
            ]
        ]);
        parent::__construct($app);
    }
}

