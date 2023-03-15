<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Output;

final class PdfOutput implements OutputFactory
{
    /**
     * @param int $status
     * @param bool $error
     * @param int|bool|array|string $response
     * @param mixed|null $dependencies
     * @return array
     */
    public function outPut(int $status, bool $error, int|bool|array|string $response, mixed $dependencies = null): mixed
    {
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf/AllUsers', [
            'users' => $response
        ]);
        return $pdf->download('mi-archivo.pdf');
    }
}
