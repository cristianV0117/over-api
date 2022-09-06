<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Shared\Infrastructure\Exceptions\ApiAuthException;

final class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ApiAuthException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (empty($request->header('authorization'))) {
            throw new ApiAuthException("Not auth authorization is empty", 400);
        }

        if (env("API_KEY") !== $request->header('authorization')) {
            throw new ApiAuthException("Not auth authorization is failed", 401);
        }

        return $next($request);
    }
}
