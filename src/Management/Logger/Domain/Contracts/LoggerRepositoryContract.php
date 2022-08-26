<?php

declare(strict_types=1);

namespace Src\Management\Logger\Domain\Contracts;

use Src\Management\Logger\Domain\Logger;
use Src\Management\Logger\Domain\ValueObjects\LoggerLogin;

interface LoggerRepositoryContract
{
    public function loggerLogin(LoggerLogin $loggerLogin): Logger;
}
