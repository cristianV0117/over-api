<?php

declare(strict_types=1);

namespace Src\Application\User\Domain\Contracts;

use Src\Application\User\Domain\ValueObjects\UserImportCriteria;

interface UserImportContract
{
    /**
     * @param UserImportCriteria $userImportCriteria
     * @return bool|array
     */
    public function import(UserImportCriteria $userImportCriteria): bool|array;
}
