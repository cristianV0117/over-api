<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Src\Application\User\Application\Store\UserStoreUseCase;
use Src\Application\User\Infrastructure\Request\UserStoreRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class UserStoreController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserStoreUseCase $useCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly UserStoreUseCase $useCase,
        private readonly OutputFactory $outputFactory
    )
    {
    }

    /**
     * @param UserStoreRequest $request
     * @return array
     */
    public function __invoke(UserStoreRequest $request): array
    {
        return $this->outputFactory->outPut(
            status: $this->created(),
            error: false,
            response: $this->useCase->__invoke($request->all())->entity()
        );
    }
}
