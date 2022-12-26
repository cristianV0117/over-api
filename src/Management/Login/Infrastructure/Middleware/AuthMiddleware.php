<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Middleware;

use Illuminate\Http\Request;
use Src\Management\Login\Application\Auth\LoginCheckAuthenticationUseCase;
use Src\Management\Login\Domain\Exceptions\AuthException;
use Closure;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class AuthMiddleware
{
    use HttpCodesHelper;

    /**
     * @param LoginCheckAuthenticationUseCase $authenticationUseCase
     */
    public function __construct(private LoginCheckAuthenticationUseCase $authenticationUseCase)
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

        $this->authenticationUseCase->__invoke($request->header('authentication'));

        return $next($request);
    }
}
