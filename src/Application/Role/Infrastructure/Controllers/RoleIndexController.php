<?php

declare(strict_types=1);

namespace Src\Application\Role\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\Role\Application\Get\RoleIndexUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class RoleIndexController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param RoleIndexUseCase $roleIndexUseCase
     */
    public function __construct(private readonly RoleIndexUseCase $roleIndexUseCase)
    {
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->json(
            $this->ok(),
            false,
            $this->roleIndexUseCase->__invoke()->entity(),
            [
                "current" => '/roles'
            ]
        );
    }
}
