<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\Task\Application\Get\TaskIndexUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class TaskIndexController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param TaskIndexUseCase $taskIndexUseCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly TaskIndexUseCase $taskIndexUseCase,
        private readonly OutputFactory $outputFactory
    )
    {
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return $this->outputFactory->outPut(
            status: $this->ok(),
            error: false,
            response: $this->taskIndexUseCase->__invoke()->entity()
        );
    }
}
