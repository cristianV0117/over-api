<?php

declare(strict_types=1);

namespace Src\Management\Logger\Infrastructure\Observers;

use Src\Management\Logger\Application\Logger\LoggerLoginUseCase;
use Src\Management\Logger\Domain\Exceptions\LoggerLoginFailedException;
use Src\Shared\Infrastructure\Observers\Observable;
use Src\Shared\Infrastructure\Observers\Observer;

final class LoggerLoginObserver implements Observer
{
    /**
     * @var LoggerLoginUseCase
     */
    private LoggerLoginUseCase $loggerLoginUseCase;

    /**
     * @param LoggerLoginUseCase $loggerLoginUseCase
     */
    public function __construct(LoggerLoginUseCase $loggerLoginUseCase)
    {
        $this->loggerLoginUseCase = $loggerLoginUseCase;
    }

    /**
     * @param Observable $observable
     * @param array $dependencies
     * @return void
     * @throws LoggerLoginFailedException
     */
    public function update(Observable $observable, array $dependencies): void
    {
        $this->loggerLoginUseCase->__invoke($dependencies);
    }
}
