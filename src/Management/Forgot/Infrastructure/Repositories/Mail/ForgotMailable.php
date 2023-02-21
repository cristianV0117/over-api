<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Repositories\Mail;

use Illuminate\Support\Facades\Mail;
use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable as ForgotMailableCriteria;

final class ForgotMailable implements ForgotMailableContract
{
    /**
     * @param ForgotMailableCriteria $mailable
     * @return Forgot
     */
    public function mail(ForgotMailableCriteria $mailable): Forgot
    {
        $response = Mail::to($mailable->value())
            ->send(new CustomMail($mailable->object()));

        if (!$response) {
            return new Forgot(null, 'MAIL_FAILED');
        }

        return new Forgot([
            "email" => $mailable->value(),
            "custom" => "Mail send"
        ]);
    }
}
