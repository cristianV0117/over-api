<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Login\LoginAuthUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class LoginAuthController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param LoginAuthUseCase $useCase
     */
    public function __construct(private readonly LoginAuthUseCase $useCase)
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->json(
            $this->ok(),
            false,
            $this->useCase->__invoke($request->all())->entity()
        );
    }
}
