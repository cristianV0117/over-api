<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Store\UserStoreUseCase;
use Src\Application\User\Infrastructure\Request\UserStoreRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class UserStoreController extends CustomController
{
    /**
     * @var UserStoreUseCase
     */
    private UserStoreUseCase $useCase;

    /**
     * @param UserStoreUseCase $useCase
     */
    public function __construct(UserStoreUseCase $useCase)
    {
        $this->useCase = $useCase;
        parent::__construct();
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function __invoke(UserStoreRequest $request): JsonResponse
    {
        return $this->defaultJsonResponse(
            201,
            false,
            $this->useCase->__invoke($request->all())->entity(),
            ['current' => '']
        );
    }
}
