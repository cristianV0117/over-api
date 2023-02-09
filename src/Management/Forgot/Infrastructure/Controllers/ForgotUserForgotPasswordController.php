<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Management\Forgot\Application\Mail\ForgotUserForgotPasswordUseCase;
use Src\Management\Forgot\Domain\Exceptions\MailFailedException;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Exception;

final class ForgotUserForgotPasswordController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param ForgotUserForgotPasswordUseCase $useCase
     */
    public function __construct(private readonly ForgotUserForgotPasswordUseCase $useCase)
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
            return $this->json(
                $this->ok(),
                false,
                $this->useCase->__invoke($request->all())->entity()
            );
        } catch (Exception $e) {
            throw new MailFailedException($e->getMessage(), 500);
        }
    }
}
