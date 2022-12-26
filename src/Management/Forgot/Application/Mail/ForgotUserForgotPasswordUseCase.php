<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Application\Mail;

use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;

final class ForgotUserForgotPasswordUseCase
{
    /**
     * @param ForgotMailableContract $mailable
     */
    public function __construct(private ForgotMailableContract $mailable)
    {
    }

    /**
     * @param array $mailable
     * @return Forgot
     */
    public function __invoke(array $mailable): Forgot
    {
        return $this->mailable->mail(new ForgotMailable($mailable["email"]));
    }
}
