<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Repositories\Eloquent;

use Baethon\LaravelCriteria\Traits\AppliesCriteria;
use Illuminate\Database\Eloquent\Model;

final class User extends Model
{
    use AppliesCriteria;

    /**
     * @var string
     */
    protected $table = "users";

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'second_name',
        'first_last_name',
        'second_last_name',
        'email',
        'cellphone',
        'password',
        'state_id'
    ];

    protected $hidden = [
        'password'
    ];
}
