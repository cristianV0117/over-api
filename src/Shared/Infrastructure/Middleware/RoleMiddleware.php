<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Auth\LoginRoleAuthenticationUseCase;
use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Shared\Domain\Exceptions\AuthException;
use Src\Shared\Domain\Exceptions\NotRoleException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class RoleMiddleware
{
    use HttpCodesHelper;

    /**
     * @param LoginRoleAuthenticationUseCase $loginRoleAuthenticationUseCase
     */
    public function __construct(private readonly LoginRoleAuthenticationUseCase $loginRoleAuthenticationUseCase)
    {
    }


    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthException
     * @throws NotRoleException
     * @throws NotLoginException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (empty($request->header('authentication'))) {
            throw new AuthException("Not jwt auth", $this->badRequest());
        }

        $this->loginRoleAuthenticationUseCase->__invoke(
            $request->header('authentication'),
            $request->route()->controller->getMiddleware()[0]["options"]["role"] ?? '*'
        );

        return $next($request);
    }
}
