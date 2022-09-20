<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Auth\LoginRoleAuthenticationUseCase;
use Src\Management\Login\Domain\Exceptions\AuthException;

final class RoleMiddleware
{
    /**
     * @param LoginRoleAuthenticationUseCase $loginRoleAuthenticationUseCase
     */
    public function __construct(
        private LoginRoleAuthenticationUseCase $loginRoleAuthenticationUseCase
    )
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
            throw new AuthException("Not jwt auth", 400);
        }

        $this->loginRoleAuthenticationUseCase->__invoke(
            $request->header('authentication'),
            $request->route()->controller->getMiddleware()[0]["options"]["role"]
        );

        return $next($request);
    }
}
