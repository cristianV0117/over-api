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
     * @return array
     */
    public function handler(): array
    {
        return [
            'iat' => time(),
            'exp' => $this->time(),
            'aud' => $this->aud(),
            'data' => $this->value()
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
