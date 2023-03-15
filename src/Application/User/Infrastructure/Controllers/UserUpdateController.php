<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Update\UserUpdateUseCase;
use Src\Application\User\Domain\Exceptions\UserUpdateException;
use Src\Application\User\Infrastructure\Request\UserUpdateRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class UserUpdateController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserUpdateUseCase $useCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly UserUpdateUseCase $useCase,
        private readonly OutputFactory $outputFactory
    )
    {
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     * @return array
     */
    public function __invoke(UserUpdateRequest $request, int $id): array
    {
        return $this->outputFactory->outPut(
            status: $this->created(),
            error: false,
            response: $this->useCase->__invoke($request->all(), $id)->entity()
        );
    }
}
