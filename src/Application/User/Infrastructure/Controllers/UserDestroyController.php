<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Destroy\UserDestroyUseCase;
use Src\Application\User\Domain\Exceptions\UserDestroyFailedException;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class UserDestroyController extends CustomController
{
    /**
     * @param UserDestroyUseCase $useCase
     */
    public function __construct(private UserDestroyUseCase $useCase)
    {
        parent::__construct();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        return $this->defaultJsonResponse(
            200,
            false,
            $this->useCase->__invoke($id)->entity()
        );
    }
}
