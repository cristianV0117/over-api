<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Output;

use Src\Shared\Infrastructure\Output\OutputFactory;

final class UserOutput implements OutputFactory
{
    /**
     * @param int $status
     * @param bool $error
     * @param int|bool|array|string $response
     * @param mixed|null $dependencies
     * @return array
     */
    public function outPut(
        int $status,
        bool $error,
        int|bool|array|string $response,
        mixed $dependencies = null
    ): array
    {
        return $this->outPut(
            status: $status,
            error: $error,
            response: $response
        );
    }
}
