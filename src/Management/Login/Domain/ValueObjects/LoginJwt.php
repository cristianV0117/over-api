<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\StringValueObject;

final class LoginJwt extends StringValueObject
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
     * @return string
     */
    public function aud(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}
