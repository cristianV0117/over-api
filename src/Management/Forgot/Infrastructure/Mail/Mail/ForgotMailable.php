<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Mail\Mail;

use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable as ForgotMailableCriteria;
use Illuminate\Support\Facades\Mail;

final class ForgotMailable implements ForgotMailableContract
{
    /**
     * @param ForgotMailableCriteria $mailable
     * @return Forgot
     */
    public function mail(ForgotMailableCriteria $mailable): Forgot
    {
        $response = Mail::to($mailable->value())
            ->send(new CustomMail("hola"));

        if (!$response) {
            return new Forgot(null);
        }

        return new Forgot([
            "email" => $mailable->value(),
            "custom" => "mensaje enviado"
        ]);
    }
}
