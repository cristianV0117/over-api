<?php

declare(strict_types=1);

namespace Src\Status\System\Infrastructure\Controllers;

final class SystemStatusController
{
    public function __invoke()
    {
        return response()->json([
            "message" => "OK"
        ]);
    }
}
