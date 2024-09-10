<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The task that the comment belongs to.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * The parent comment of this comment (if it's a reply).
     */
    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * The replies to this comment (if it's a parent comment).
     */
    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
