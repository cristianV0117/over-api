<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Login\LoginAuthUseCase;
use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class LoginAuthController extends CustomController
{
    /**
     * @param LoginAuthUseCase $useCase
     */
    public function __construct(private LoginAuthUseCase $useCase)
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws NotLoginException
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->defaultJsonResponse(
            200,
            false,
            $this->useCase->__invoke($request->all())->entity(),
            ['current' => '']
        );
    }
}
