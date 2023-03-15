<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Management\Login\Application\Login\LoginAuthUseCase;
use Src\Management\Login\Infrastructure\Output\LoginOutput;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class LoginAuthController
{
    use HttpCodesHelper;

    /**
     * @param LoginAuthUseCase $useCase
     * @param LoginOutput $loginResponse
     */
    public function __construct(
        private readonly LoginAuthUseCase $useCase,
        private readonly OutputFactory $loginResponse
    )
    {
    }

    /**
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        return $this->loginResponse->outPut(
            status: $this->ok(),
            error: false,
            response: $this->useCase->__invoke($request->all())->entity()
        );
    }
}
