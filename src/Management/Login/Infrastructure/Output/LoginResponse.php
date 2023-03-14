<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Output;

use Src\Shared\Infrastructure\Responses\ResponseFactory;

final class LoginResponse implements ResponseFactory
{
    /**
     * @param int $status
     * @param bool $error
     * @param int|bool|array|string $response
     * @param mixed|null $dependencies
     * @return mixed
     */
    public function response(
        int $status,
        bool $error,
        int|bool|array|string $response,
        mixed $dependencies = null
    ): array
    {
        return $this->response(
            status: $status,
            error: $error,
            response: $response
        );
    }
}
