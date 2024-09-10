<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\User\Entities\User;
use Modules\User\Entities\Task;

class Project extends Model
{
    protected $guarded = [];

    /**
     * The users that belong to the project.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The tasks that belong to the project.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
