<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Helpers;

trait AuthHelper
{
    /**
     * @return string
     */
    public function aud(): string
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        if (!empty($_SERVER['REMOTE_ADDR'])) {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud ?? null);
    }
}
