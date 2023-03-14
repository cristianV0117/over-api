<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Src\Application\User\Application\Get\UserShowUseCase;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Responses\ResponseFactory;

final class UserShowController
{
    use HttpCodesHelper;

    /**
     * @param UserShowUseCase $useCase
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        private readonly UserShowUseCase $useCase,
        private readonly ResponseFactory $responseFactory
    )
    {
    }

    /**
     * @param int $id
     * @return array
     */
    public function __invoke(int $id): array
    {
        return $this->responseFactory->response(
            status: $this->ok(),
            error: false,
            response: $this->useCase->__invoke($id)->entity(),
            dependencies: [
                "current" => '/users/' . $id
            ]
        );
    }
}
