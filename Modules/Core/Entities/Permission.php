<?php

namespace Modules\Core\Entities;

use Modules\Core\Database\factories\PermissionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Modules\User\Entities\TeacherPermission
 *
 * @property string $id
 * @property string $name
 * @property string $permission_uuid
 * @property string $slug
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereId($value)
 * @mixin Model
 */
class Permission extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    /**
     * @return PermissionFactory
     */
    protected static function newFactory()
    {
        return PermissionFactory::new();
    }


    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
