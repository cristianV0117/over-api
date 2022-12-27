<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Update\UserUpdateUseCase;
use Src\Application\User\Domain\Exceptions\UserUpdateException;
use Src\Application\User\Infrastructure\Request\UserUpdateRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class UserUpdateController extends CustomController
{
    /**
     * @param UserUpdateUseCase $useCase
     */
    public function __construct(private UserUpdateUseCase $useCase)
    {
        parent::__construct();
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UserUpdateRequest $request, int $id): JsonResponse
    {
        return $this->defaultJsonResponse(
            200,
            false,
            $this->useCase->__invoke($request->all(), $id)->entity()
        );
    }
}
