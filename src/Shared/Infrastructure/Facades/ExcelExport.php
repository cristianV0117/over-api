<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Facades;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;

final class ExcelExport implements FromArray
{
    /**
     * @param mixed $response
     */
    public function __construct(
        private readonly mixed $response
    )
    {
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->response;
    }
}
