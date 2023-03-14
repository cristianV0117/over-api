<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Src\Application\User\Application\Get\UserShowUseCase;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class UserShowController
{
    use HttpCodesHelper;

    /**
     * @param UserShowUseCase $useCase
     * @param OutputFactory $responseFactory
     */
    public function __construct(
        private readonly UserShowUseCase $useCase,
        private readonly OutputFactory $responseFactory
    )
    {
    }

    /**
     * @param int $id
     * @return array
     */
    public function __invoke(int $id): array
    {
        return $this->responseFactory->outPut(
            status: $this->ok(),
            error: false,
            response: $this->useCase->__invoke($id)->entity(),
            dependencies: [
                "current" => '/users/' . $id
            ]
        );
    }
}
