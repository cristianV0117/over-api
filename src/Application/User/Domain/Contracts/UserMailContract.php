<?php

declare(strict_types=1);

namespace Src\Application\User\Domain\Contracts;

use Src\Application\User\Domain\Events\UserCreatedEvent;

interface UserMailContract
{
    /**
     * @param UserCreatedEvent $mailable
     * @return void
     */
    public function userCreatedNotify(UserCreatedEvent $mailable): void;
}
