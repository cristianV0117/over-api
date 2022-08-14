<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Middleware;

use Illuminate\Http\Request;
use Src\Management\Login\Application\Auth\LoginCheckAuthenticationUseCase;
use Src\Management\Login\Domain\Exceptions\AuthException;
use Closure;

final class AuthMiddleware
{

    private LoginCheckAuthenticationUseCase $authenticationUseCase;

    public function __construct(LoginCheckAuthenticationUseCase $authenticationUseCase)
    {
        $this->authenticationUseCase = $authenticationUseCase;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (empty($request->header('authentication'))) {
            throw new AuthException("Not jwt auth", 400);
        }

        $this->authenticationUseCase->__invoke($request->header('authentication'));

        return $next($request);
    }
}
