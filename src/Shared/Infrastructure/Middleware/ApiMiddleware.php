<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Shared\Infrastructure\Exceptions\ApiAuthException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class ApiMiddleware
{
    use HttpCodesHelper;

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
            throw new ApiAuthException("Not auth authorization is empty", $this->badRequest());
        }

        if (null === env("API_KEY")) {
            throw new ApiAuthException("Error with environment", $this->internalServerError());
        }

        if (env("API_KEY") !== $request->header('authorization')) {
            throw new ApiAuthException("Not auth authorization is failed", $this->unauthorized());
        }

        return $next($request);
    }
}
