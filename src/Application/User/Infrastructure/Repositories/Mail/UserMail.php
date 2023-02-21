<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Repositories\Mail;

use Illuminate\Support\Facades\Mail;
use Src\Application\User\Domain\Contracts\UserMailContract;
use Src\Application\User\Domain\Events\UserCreatedEvent;

final class UserMail implements UserMailContract
{
    /**
     * @param UserCreatedEvent $mailable
     * @return void
     */
    public function userCreatedNotify(UserCreatedEvent $mailable): void
    {
        Mail::to($mailable->mailNotification()->to)
            ->send(new CustomMail($mailable->mailNotification()));
    }
}
