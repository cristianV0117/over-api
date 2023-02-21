<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Get\UserIndexUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\RolesHelper;
use Src\Shared\Infrastructure\Middleware\RoleMiddleware;

final class UserIndexController extends CustomController
{
    use RolesHelper;

    /**
     * @param UserIndexUseCase $useCase
     */
    public function __construct(private UserIndexUseCase $useCase)
    {
        $this->middleware(RoleMiddleware::class, [
            'role' => $this->superAdmin()
        ]);
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->json(
            200,
            false,
            $this->useCase->__invoke()->entity(),
            [
                "current" => '/users'
            ]
        );
    }
}
