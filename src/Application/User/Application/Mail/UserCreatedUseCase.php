<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Mail;

use Src\Application\User\Domain\Contracts\UserMailContract;
use Src\Application\User\Domain\Events\UserCreatedEvent;

final class UserCreatedUseCase
{
    /**
     * @param UserMailContract $userMail
     */
    public function __construct(private readonly UserMailContract $userMail)
    {
    }

    /**
     * @param UserCreatedEvent $mail
     * @return void
     */
    public function __invoke(UserCreatedEvent $mail): void
    {
        $this->userMail->userCreatedNotify($mail);
    }
}
