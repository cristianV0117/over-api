<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Management\Login\Application\Login\LoginAuthUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;

final class LoginAuthController extends CustomController
{
    /**
     * @var LoginAuthUseCase
     */
    private LoginAuthUseCase $useCase;

    /**
     * @param LoginAuthUseCase $useCase
     */
    public function __construct(LoginAuthUseCase $useCase)
    {
        $this->useCase = $useCase;
        parent::__construct();
    }

    public function __invoke(Request $request)
    {
        dd($this->useCase->__invoke($request->all()));
    }
}
