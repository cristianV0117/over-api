<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Helpers;

trait JwtHelper
{
    /**
     * @var string
     */
    public string $jwt;

    /**
     * @param string $jwt
     * @return void
     */
    public function setJwt(string $jwt): void
    {
        $this->jwt = $jwt;
    }

    /**
     * @return string
     */
    public function jwt(): string
    {
        return $this->jwt;
    }
}
