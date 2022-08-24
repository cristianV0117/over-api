<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Domain\ValueObjects;

use Src\Shared\Domain\Helpers\EnvHelper;
use Src\Shared\Domain\ValueObjects\StringValueObject;
use stdClass;

final class ForgotMailable extends StringValueObject
{
    use EnvHelper;

    /**
     * @var string
     */
    private string $mailObject;

    /**
     * @return stdClass
     */
    public function object(): stdClass
    {
        $object = new stdClass();
        $object->resetPassword = $this->webDomain() . '/reset-password/' . base64_encode($this->value());
        return $object;
    }
}
