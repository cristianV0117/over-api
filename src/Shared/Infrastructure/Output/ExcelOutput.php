<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Output;

use Maatwebsite\Excel\Facades\Excel;
use Src\Shared\Infrastructure\Facades\ExcelExport;

final class ExcelOutput implements OutputFactory
{
    /**
     * @param int $status
     * @param bool $error
     * @param array|bool|int|string $response
     * @param mixed|null $dependencies
     * @return mixed
     */
    public function outPut(int $status, bool $error, array|bool|int|string $response, mixed $dependencies = null): mixed
    {
        return Excel::download(new ExcelExport($response), 'users.csv');
    }
}
