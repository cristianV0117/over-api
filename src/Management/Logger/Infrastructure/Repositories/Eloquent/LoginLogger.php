<?php

declare(strict_types=1);

namespace Src\Management\Logger\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class LoginLogger extends Model
{
    /**
     * @var string
     */
    protected $table = "login_logger";

    /**
     * @var string[]
     */
    protected $fillable = [
        'type',
        'user_id',
        'ip',
        'browser',
        'os'
    ];
}
