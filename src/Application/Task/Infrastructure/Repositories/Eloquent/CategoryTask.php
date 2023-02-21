<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class CategoryTask extends Model
{
    protected $table = 'categories_tasks';

    protected $fillable = [
        'category',
        'description',
        'status'
    ];
}
