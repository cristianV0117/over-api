<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\Task\Application\Get\TaskIndexUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class TaskIndexController extends CustomController
{
    /**
     * @param TaskIndexUseCase $taskIndexUseCase
     */
    public function __construct(
        private readonly TaskIndexUseCase $taskIndexUseCase
    )
    {
        parent::__construct();
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->json(
            200,
            false,
            $this->taskIndexUseCase->__invoke()->entity()
        );
    }
}
