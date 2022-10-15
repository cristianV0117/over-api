<?php

namespace Src\Application\User\Domain\Contracts;

interface UserMailContract
{
    public function mail($mailable);
}
