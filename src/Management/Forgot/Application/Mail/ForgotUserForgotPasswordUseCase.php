<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Application\Mail;

use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\Exceptions\MailFailedException;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;

final class ForgotUserForgotPasswordUseCase
{
    /**
     * @var ForgotMailableContract
     */
    private ForgotMailableContract $mailable;

    /**
     * @param ForgotMailableContract $mailable
     */
    public function __construct(ForgotMailableContract $mailable)
    {
        $this->mailable = $mailable;
    }

    /**
     * @param array $mailable
     * @return Forgot
     * @throws MailFailedException
     */
    public function __invoke(array $mailable): Forgot
    {
        $forgot = $this->mailable->mail(new ForgotMailable($mailable["email"]));
        $this->forgotStatus($forgot);
        return $forgot;
    }

    /**
     * @param Forgot $forgot
     * @return void
     * @throws MailFailedException
     */
    private function forgotStatus(Forgot $forgot): void
    {
        if (is_null($forgot->entity())) {
            throw new MailFailedException('No se puedo envíar el correo', 401);
        }
    }
}
