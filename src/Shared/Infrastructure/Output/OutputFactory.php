<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Output;

interface OutputFactory
{
    /**
     * @param int $status
     * @param bool $error
     * @param array|string|int|bool $response
     * @param mixed $dependencies
     * @return mixed
     */
    public function outPut(
        int $status,
        bool $error,
        array|string|int|bool $response,
        mixed $dependencies = null
    ): mixed;
}
