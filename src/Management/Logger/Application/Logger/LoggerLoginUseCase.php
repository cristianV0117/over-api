<?php

declare(strict_types=1);

namespace Src\Management\Logger\Application\Logger;

use Src\Management\Logger\Domain\Contracts\LoggerRepositoryContract;
use Src\Management\Logger\Domain\Exceptions\LoggerLoginFailedException;
use Src\Management\Logger\Domain\Logger;
use Src\Management\Logger\Domain\ValueObjects\LoggerLogin;

final class LoggerLoginUseCase
{
    /**
     * @var LoggerRepositoryContract
     */
    private LoggerRepositoryContract $repository;

    /**
     * @param LoggerRepositoryContract $repository
     */
    public function __construct(LoggerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $dependencies
     * @return Logger
     * @throws LoggerLoginFailedException
     */
    public function __invoke(array $dependencies): Logger
    {
        $logger = $this->repository->loggerLogin(new LoggerLogin($dependencies));
        $this->loggerStatus($logger);
        return $logger;
    }

    /**
     * @param Logger $logger
     * @return void
     * @throws LoggerLoginFailedException
     */
    private function loggerStatus(Logger $logger): void
    {
        if (is_null($logger->entity())) {
            throw new LoggerLoginFailedException("Error with logger login", 500);
        }
    }
}
