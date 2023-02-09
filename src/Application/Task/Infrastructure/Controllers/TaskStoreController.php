<?php

namespace Src\Application\Task\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Application\Task\Application\Store\TaskStoreUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class TaskStoreController extends CustomController
{
    public function __construct(private readonly TaskStoreUseCase $taskStoreUseCase)
    {
        parent::__construct();
    }

    public function __invoke(Request $request)
    {
        return $this->json(
            201,
            false,
            $this->taskStoreUseCase->__invoke($request->toArray())->entity()
        );
    }
}
