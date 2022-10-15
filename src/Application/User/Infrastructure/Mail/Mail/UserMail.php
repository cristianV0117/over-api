<?php

namespace Src\Application\User\Infrastructure\Mail\Mail;

use Illuminate\Support\Facades\Mail;
use Src\Application\User\Domain\Contracts\UserMailContract;

final class UserMail implements UserMailContract
{

    public function mail($mail)
    {
        $response = Mail::to($mail->to)
            ->send(new CustomMail($mail));

        dd($response);
    }
}
