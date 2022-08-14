<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

class LoginCriteria extends CriteriaValueObject
{
    /**
     * @param string $passwordRequest
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $passwordRequest, string $password): bool
    {
        return password_verify($passwordRequest, $password);
    }
}
