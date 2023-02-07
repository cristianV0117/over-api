<?php

namespace Src\Application\Role\Infrastructure\Controllers;

use Src\Application\Role\Application\Get\RoleIndexUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class RoleIndexController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(private RoleIndexUseCase $roleIndexUseCase)
    {
        parent::__construct();
    }

    public function __invoke()
    {
        return $this->defaultJsonResponse(
            $this->ok(),
            false,
            $this->roleIndexUseCase->__invoke()->entity(),
            [
                "current" => '/roles'
            ]
        );
    }
}
