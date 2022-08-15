<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\Helpers\AuthHelper;
use Src\Shared\Domain\Helpers\EnvHelper;
use Src\Shared\Domain\ValueObjects\StringValueObject;

final class LoginJwt extends StringValueObject
{
    use AuthHelper, EnvHelper;
}
