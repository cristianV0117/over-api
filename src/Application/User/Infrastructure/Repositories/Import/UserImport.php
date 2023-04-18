<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Repositories\Import;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Src\Application\User\Domain\Contracts\UserImportContract;
use Src\Application\User\Domain\ValueObjects\UserImportCriteria;

final class UserImport implements UserImportContract
{
    /**
     * @param UserImportCriteria $userImportCriteria
     * @return bool|array
     */
    public function import(UserImportCriteria $userImportCriteria): bool|array
    {
        Storage::disk($userImportCriteria->storageFile())->put(
            $userImportCriteria->fileName(),
            $userImportCriteria->value()
        );

        return Excel::toArray(new UsersImport, $userImportCriteria->value())[0];
    }
}
