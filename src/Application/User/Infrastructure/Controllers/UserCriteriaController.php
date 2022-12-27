<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\User\Application\Get\UserCriteriaUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Criteria\HandlerCriteria;

final class UserCriteriaController extends CustomController
{
    /**
     * @param UserCriteriaUseCase $useCase
     */
    public function __construct(
        private UserCriteriaUseCase $useCase
    )
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->defaultJsonResponse(
            200,
            false,
            $this->useCase->__invoke(
                (new HandlerCriteria($request->toArray()))->criteria()
            )->entity()
        );
    }
}
