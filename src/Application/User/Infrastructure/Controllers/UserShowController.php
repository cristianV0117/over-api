<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Get\UserShowUseCase;
use Src\Application\User\Domain\Exceptions\UserNotFoundException;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class UserShowController extends CustomController
{
    /**
     * @param UserShowUseCase $useCase
     */
    public function __construct(private readonly UserShowUseCase $useCase)
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
            $this->useCase->__invoke($id)->entity(),
            [
                "current" => '/users/' . $id
            ]
        );
    }
}
