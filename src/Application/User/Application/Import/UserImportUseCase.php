<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Import;

use Src\Application\User\Domain\Contracts\UserImportContract;
use Src\Application\User\Domain\ValueObjects\UserImportCriteria;

final class UserImportUseCase
{
    public function __construct(
        private readonly UserImportContract $userImportContract
    )
    {
    }

    public function __invoke(mixed $file)
    {
        return $this->userImportContract->import(new UserImportCriteria($file));
    }
}
