<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Admin\Entities\Project;

class Task extends Model
{
    protected $guarded = [];

    /**
     * The project that the task belongs to.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * The user who is assigned to the task.
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    /**
     * The parent task of this task (if it's a subtask).
     */
    public function parentTask(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * The subtasks of this task.
     */
    public function subtasks(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
