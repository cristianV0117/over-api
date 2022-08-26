<?php

declare(strict_types=1);

namespace Src\Management\Logger\Infrastructure\Repositories\Eloquent;

use Src\Management\Logger\Domain\Contracts\LoggerRepositoryContract;
use Src\Management\Logger\Domain\Logger;
use Src\Management\Logger\Domain\ValueObjects\LoggerLogin;

final class LoggerRepository implements LoggerRepositoryContract
{
    /**
     * @var LoginLogger
     */
    private LoginLogger $model;

    /**
     * @param LoginLogger $model
     */
    public function __construct(LoginLogger $model)
    {
        $this->model = $model;
    }

    /**
     * @param LoggerLogin $loggerLogin
     * @return Logger
     */
    public function loggerLogin(LoggerLogin $loggerLogin): Logger
    {
        $logger = $this->model->create($loggerLogin->handler());

        if (!$logger) {
            return new Logger(null);
        }

        return new Logger($logger->toArray());
    }
}
