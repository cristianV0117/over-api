<?php

namespace Src\Shared\Infrastructure\Helper;

use Illuminate\Support\Carbon;

trait DateHelper
{
    /**
     * @return Carbon
     */
    public function now(): Carbon
    {
        return Carbon::now();
    }
}
