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
     * @var UserShowUseCase
     */
    private UserShowUseCase $useCase;

    /**
     * @param UserShowUseCase $useCase
     */
    public function __construct(UserShowUseCase $useCase)
    {
        $this->useCase = $useCase;
        parent::__construct();
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        return $this->defaultJsonResponse(
            200,
            false,
            $this->useCase->__invoke($id)->entity(),
            [
                "current" => '/users/' . $id
            ]
        );
    }
}
