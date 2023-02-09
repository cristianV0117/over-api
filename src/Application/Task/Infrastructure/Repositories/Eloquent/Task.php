<?php

namespace Src\Application\Task\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Task extends Model
{
    /**
     * @var string
     */
    protected $table = "tasks";

    protected $fillable = [
        'task',
        'description',
        'status',
        'priority',
        'dead_line',
        'closing_date',
        'user_id',
        'categorie_task_id'
    ];
}
