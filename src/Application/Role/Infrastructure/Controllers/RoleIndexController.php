<?php

declare(strict_types=1);

namespace Src\Application\Role\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\Role\Application\Get\RoleIndexUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class RoleIndexController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param RoleIndexUseCase $roleIndexUseCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly RoleIndexUseCase $roleIndexUseCase,
        private readonly OutputFactory $outputFactory
    )
    {
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return $this->outputFactory->outPut(
            status: $this->created(),
            error: false,
            response: $this->roleIndexUseCase->__invoke()->entity(),
            dependencies: [
                "current" => '/roles'
            ]
        );
    }
}
