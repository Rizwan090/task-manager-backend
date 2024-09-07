<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Database\factories\RoleFactory;
use Modules\User\Entities\User;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Modules\User\Entities\Role
 *
 * @property string $id
 * @property string $name
 * @property string $role_uuid
 * @property string $slug
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role create($value)
 * @mixin Model
 */

class Role extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];


    protected $with = [
      'permissions'
    ];
    /**
     * @return RoleFactory
     */
    protected static function newFactory()
    {
        return RoleFactory::new();
    }


    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function users(){
        return $this->hasMany(User::class , "role_id");
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class , "permission_role");
    }

    public function hasPermission($permission):bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }
}
