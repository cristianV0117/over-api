<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Management\Forgot\Application\Mail\ForgotUserForgotPasswordUseCase;
use Src\Management\Forgot\Domain\Exceptions\MailFailedException;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class ForgotUserForgotPasswordController extends CustomController
{
    /**
     * @param ForgotUserForgotPasswordUseCase $useCase
     */
    public function __construct(private ForgotUserForgotPasswordUseCase $useCase)
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws MailFailedException
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            return $this->defaultJsonResponse(
                200,
                false,
                $this->useCase->__invoke($request->all())->entity(),
                ["current" => '']
            );
        } catch (\Exception $e) {
            throw new MailFailedException($e->getMessage(), 500);
        }
    }
}
