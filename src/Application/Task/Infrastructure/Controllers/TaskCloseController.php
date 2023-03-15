<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\Task\Application\Update\TaskCloseUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class TaskCloseController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param TaskCloseUseCase $taskCloseUseCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly TaskCloseUseCase $taskCloseUseCase,
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
            response: $this->taskCloseUseCase->__invoke($id)->entity()
        );
    }
}
