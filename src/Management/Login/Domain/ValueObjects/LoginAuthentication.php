<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

final class LoginAuthentication extends CriteriaValueObject
{
    /**
     * @var array|object
     */
    private array|object $handler;

    /**
     * @param object|array $value
     */
    public function __construct(object|array $value)
    {
        parent::__construct($value);
        $this->handler = $value;
    }

    /**
     * @return array
     */
    public function handler(): array
    {
        return [
            'exp' => $this->time(),
            'aud' => $this->aud(),
            'data' => $this->handler
        ];
    }

    /**
     * @return mixed
     */
    public function private(): mixed
    {
        return env("API_JWT");
    }

    /**
     * @return float|int
     */
    private function time(): float|int
    {
        $time = time();
        return $time + (60*60);
    }

    /**
     * @return string
     */
    private function aud(): string
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
