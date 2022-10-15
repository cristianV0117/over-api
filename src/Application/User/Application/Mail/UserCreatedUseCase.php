<?php

namespace Src\Application\User\Application\Mail;

use Src\Application\User\Domain\Contracts\UserMailContract;

final class UserCreatedUseCase
{
    /**
     * @param UserMailContract $userMail
     */
    public function __construct(private UserMailContract $userMail)
    {
    }

    public function __invoke(\stdClass $mail)
    {
        $this->userMail->mail($mail);
    }
}
