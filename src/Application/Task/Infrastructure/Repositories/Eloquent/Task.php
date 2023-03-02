<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Src\Application\User\Infrastructure\Repositories\Eloquent\User;

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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
