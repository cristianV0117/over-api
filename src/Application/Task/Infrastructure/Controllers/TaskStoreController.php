<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\Task\Application\Store\TaskStoreUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class TaskStoreController extends CustomController
{
    /**
     * @param TaskStoreUseCase $taskStoreUseCase
     */
    public function __construct(private readonly TaskStoreUseCase $taskStoreUseCase)
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->json(
            201,
            false,
            $this->taskStoreUseCase->__invoke(
                $request->toArray(),
                $request->header('authentication')
            )->entity()
        );
    }
}
