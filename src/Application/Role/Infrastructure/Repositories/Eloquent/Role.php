<?php

namespace Src\Application\Role\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Role extends Model
{
    /**
     * @var string
     */
    protected $table = "roles";
}
