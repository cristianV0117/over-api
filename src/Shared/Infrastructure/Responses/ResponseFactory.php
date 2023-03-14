<?php

namespace Src\Shared\Infrastructure\Responses;

interface ResponseFactory
{
    /**
     * @param int $status
     * @param bool $error
     * @param array|string|int|bool $response
     * @param mixed $dependencies
     * @return mixed
     */
    public function response(
        int $status,
        bool $error,
        array|string|int|bool $response,
        mixed $dependencies = null
    ): array;
}
