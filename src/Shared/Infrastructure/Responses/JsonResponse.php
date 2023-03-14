<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Responses;

use Src\Shared\Infrastructure\Helper\ResponseHelper;

final class JsonResponse implements ResponseFactory
{
    use ResponseHelper;

    /**
     * @param int $status
     * @param bool $error
     * @param int|bool|array|string $response
     * @param array|null $dependencies
     * @return mixed
     */
    public function response(
        int $status,
        bool $error,
        int|bool|array|string $response,
        mixed $dependencies = null
    ): array
    {
        return $this->responseForJson(
            status: $status,
            error: $error,
            response: $response,
            domain: env('API_ROUTE'),
            dependencies: $dependencies
        );
    }
}
