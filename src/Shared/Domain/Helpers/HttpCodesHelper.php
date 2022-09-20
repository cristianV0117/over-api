<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Helpers;

trait HttpCodesHelper
{
    /**
     * @return int
     */
    public function ok(): int
    {
        return 200;
    }

    /**
     * @return int
     */
    public function created(): int
    {
        return 201;
    }

    /**
     * @return int
     */
    public function noContent(): int
    {
        return 204;
    }

    /**
     * @return int
     */
    public function badRequest(): int
    {
        return 400;
    }

    /**
     * @return int
     */
    public function unauthorized(): int
    {
        return 401;
    }

    /**
     * @return int
     */
    public function forbidden(): int
    {
        return 403;
    }

    /**
     * @return int
     */
    public function notFound(): int
    {
        return 404;
    }

    /**
     * @return int
     */
    public function internalServerError(): int
    {
        return 500;
    }
}
