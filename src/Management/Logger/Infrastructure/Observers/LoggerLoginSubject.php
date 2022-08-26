<?php

declare(strict_types=1);

namespace Src\Management\Logger\Infrastructure\Observers;

use Src\Shared\Infrastructure\Observers\Observable;
use Src\Shared\Infrastructure\Observers\Observer;

final class LoggerLoginSubject implements Observable
{
    /**
     * @var array
     */
    private array $login;

    /**
     * @param Observer $observer
     * @return void
     */
    public function attach(Observer $observer): void
    {
        $this->login[] = $observer;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function detach(Observer $observer): void
    {
        // TODO: Implement detach() method.
    }

    /**
     * @param array $dependencies
     * @return void
     */
    public function notify(array $dependencies): void
    {
        foreach ($this->login as $observer) {
            $observer->update($this, $dependencies);
        }
    }

    /**
     * @param array $dependencies
     * @return void
     */
    public function notifyUserLogin(array $dependencies): void
    {
        $this->notify($dependencies);
    }
}
