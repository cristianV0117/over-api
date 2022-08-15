<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\Helpers\AuthHelper;
use Src\Shared\Domain\Helpers\EnvHelper;
use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

final class LoginAuthentication extends CriteriaValueObject
{
    use AuthHelper, EnvHelper;

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
     * @return float|int
     */
    private function time(): float|int
    {
        $time = time();
        return $time + (60*60);
    }
}
