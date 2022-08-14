<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Helper;

trait ResponseHelper
{
    /**
     * @param int $status
     * @param bool $error
     * @param array|string|int|bool $response
     * @param string $domain
     * @param array|null $dependencies
     * @return array
     */
    public function json(
        int $status,
        bool $error,
        array|string|int|bool $response,
        string $domain,
        ?array $dependencies
    ): array
    {
        return [
            "status"      => $status,
            "error"       => $error,
            "message"     => $response,
            "current_url" => $domain . $dependencies['current']
        ];
    }
}
