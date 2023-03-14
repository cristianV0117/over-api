<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Management\Login\Application\Login\LoginAuthUseCase;
use Src\Management\Login\Infrastructure\Output\LoginResponse;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Responses\ResponseFactory;

final class LoginAuthController
{
    use HttpCodesHelper;

    /**
     * @param LoginAuthUseCase $useCase
     * @param LoginResponse $loginResponse
     */
    public function __construct(
        private readonly LoginAuthUseCase $useCase,
        private readonly ResponseFactory $loginResponse
    )
    {
    }

    /**
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        return $this->loginResponse->response(
            status: $this->ok(),
            error: false,
            response: $this->useCase->__invoke($request->all())->entity()
        );
    }
}
