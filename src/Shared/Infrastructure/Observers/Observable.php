<?php

namespace Src\Shared\Infrastructure\Observers;

interface Observable
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function attach(Observer $observer): void;

    /**
     * @param Observer $observer
     * @return void
     */
    public function detach(Observer $observer): void;

    /**
     * @param array $dependencies
     * @return void
     */
    public function notify(array $dependencies): void;
}
