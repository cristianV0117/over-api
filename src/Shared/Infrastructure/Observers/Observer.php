<?php

namespace Src\Shared\Infrastructure\Observers;

interface Observer
{
    /**
     * @param Observable $observable
     * @param array $dependencies
     * @return void
     */
    public function update(Observable $observable, array $dependencies): void;
}
