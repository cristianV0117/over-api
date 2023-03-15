<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Application\Task\Application\Store\TaskStoreUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class TaskStoreController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param TaskStoreUseCase $taskStoreUseCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly TaskStoreUseCase $taskStoreUseCase,
        private readonly OutputFactory $outputFactory
    )
    {
    }

    /**
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        return $this->outputFactory->outPut(
            status: $this->created(),
            error: false,
            response: $this->taskStoreUseCase->__invoke(
                $request->toArray(),
                $request->header('authentication')
            )->entity()
        );
    }
}
