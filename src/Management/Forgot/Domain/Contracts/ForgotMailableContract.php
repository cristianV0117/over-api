<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Domain\Contracts;

use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;

interface ForgotMailableContract
{
    /**
     * @param ForgotMailable $mailable
     * @return Forgot
     */
    public function mail(ForgotMailable $mailable): Forgot;
}
