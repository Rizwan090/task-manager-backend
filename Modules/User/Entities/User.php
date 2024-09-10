<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Modules\Admin\Entities\Project;
use Modules\Core\Entities\Role;

class User extends Model
{
    use HasApiTokens;

    protected $guarded = [];

    /**
     * The role that the user belongs to.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * The projects that the user is part of.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * The tasks that the user is assigned to.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assignee_id');
    }
}
