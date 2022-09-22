<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\User\Domain\Exceptions\UserUpdateException;
use Src\Management\Forgot\Application\Update\ForgotUserResetPasswordUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class ForgotUserResetPasswordController extends CustomController
{
    /**
     * @param ForgotUserResetPasswordUseCase $useCase
     */
    public function __construct(private ForgotUserResetPasswordUseCase $useCase)
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws UserUpdateException
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->defaultJsonResponse(
            200,
            false,
            $this->useCase->__invoke($request->all())->entity(),
            ["current" => '']
        );
    }
}
