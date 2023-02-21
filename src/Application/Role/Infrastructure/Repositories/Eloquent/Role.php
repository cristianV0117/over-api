<?php

declare(strict_types=1);

namespace Src\Application\Role\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Role extends Model
{
    /**
     * @var string
     */
    protected $table = "roles";

    protected $hidden = ['pivot'];
}
