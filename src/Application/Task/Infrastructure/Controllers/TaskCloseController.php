<?php

namespace Src\Application\Task\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\Task\Application\Update\TaskCloseUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class TaskCloseController extends CustomController
{
    /**
     * @param TaskCloseUseCase $taskCloseUseCase
     */
    public function __construct(private readonly TaskCloseUseCase $taskCloseUseCase)
    {
        parent::__construct();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        return $this->json(
            200,
            false,
            $this->taskCloseUseCase->__invoke($id)->entity()
        );
    }
}
