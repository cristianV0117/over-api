<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Destroy\UserDestroyUseCase;
use Src\Application\User\Domain\Exceptions\UserDestroyFailedException;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class UserDestroyController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserDestroyUseCase $useCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly UserDestroyUseCase $useCase,
        private readonly OutputFactory $outputFactory
    )
    {
    }

    /**
     * @param int $id
     * @return array
     */
    public function __invoke(int $id): array
    {
        return $this->outputFactory->outPut(
            status: $this->ok(),
            error: false,
            response: $this->useCase->__invoke($id)->entity()
        );
    }
}
