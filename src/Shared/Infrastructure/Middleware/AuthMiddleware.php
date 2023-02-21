<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Auth\LoginCheckAuthenticationUseCase;
use Src\Shared\Domain\Exceptions\AuthException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class AuthMiddleware
{
    use HttpCodesHelper;

    /**
     * @param LoginCheckAuthenticationUseCase $authenticationUseCase
     */
    public function __construct(private readonly LoginCheckAuthenticationUseCase $authenticationUseCase)
    {
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
            throw new AuthException("Not jwt auth", $this->badRequest());
        }

        $auth = $this->authenticationUseCase->__invoke($request->header('authentication'));

        if (!$auth) {
            throw new AuthException("invalid token or invalid user or expired token", 401);
        }

        return $next($request);
    }
}
