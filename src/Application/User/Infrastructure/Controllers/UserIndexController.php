<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;
use Src\Application\User\Application\Get\UserIndexUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\RolesHelper;
use Src\Shared\Infrastructure\Middleware\RoleMiddleware;

final class UserIndexController extends CustomController
{
    use RolesHelper, HttpCodesHelper;

    /**
     * @param UserIndexUseCase $useCase
     * @param OutputFactory $responseFactory
     */
    public function __construct(
        private readonly UserIndexUseCase $useCase,
        private readonly OutputFactory $responseFactory
    )
    {
        $this->middleware(RoleMiddleware::class, [
            'role' => $this->superAdmin()
        ]);
    }

    /**
     * @return array
     */
    public function __invoke(): mixed
    {
        return $this->responseFactory->outPut(
            status: $this->ok(),
            error: false,
            response: $this->useCase->__invoke()->entity(),
            dependencies: [
            "current" => '/users'
        ]
        );
    }
}
