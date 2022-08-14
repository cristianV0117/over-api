<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Routes;

use Src\Shared\Infrastructure\Controllers\CustomController;

final class UserIndexController extends CustomController
{
    public function __invoke()
    {
        return response("", 200);
    }
}
