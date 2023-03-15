<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Output;

use Src\Shared\Infrastructure\Helper\ResponseHelper;

final class JsonOutput implements OutputFactory
{
    use ResponseHelper;

    /**
     * @param int $status
     * @param bool $error
     * @param int|bool|array|string $response
     * @param array|null $dependencies
     * @return array
     */
    public function outPut(
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
