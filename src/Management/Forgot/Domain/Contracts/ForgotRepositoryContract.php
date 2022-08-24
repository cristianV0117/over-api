<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Domain\Contracts;

use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotReset;

interface ForgotRepositoryContract
{
    /**
     * @param ForgotReset $reset
     * @return Forgot
     */
    public function reset(ForgotReset $reset): Forgot;
}
