<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Helpers;

trait EnvHelper
{
    /**
     * @return array
     */
    public function encrypt(): array
    {
        return [env("API_ENCRYPT")];
    }

    /**
     * @return string
     */
    public function secret(): string
    {
        return env("API_JWT");
    }

    /**
     * @return mixed
     */
    public function private(): mixed
    {
        return env("API_JWT");
    }
}
