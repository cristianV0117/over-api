<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

final class ForgotReset extends CriteriaValueObject
{
    /**
     * @var object|array
     */
    private object|array $handler;

    /**
     * @param object|array $value
     */
    public function __construct(object|array $value)
    {
        parent::__construct($value);
        $this->handler = $value;
        $this->password();
    }

    /**
     * @return array
     */
    public function handler(): array
    {
        return $this->handler;
    }

    /**
     * @return void
     */
    private function password(): void
    {
        $this->handler["password"] = password_hash($this->handler["password"], PASSWORD_DEFAULT);
    }
}
