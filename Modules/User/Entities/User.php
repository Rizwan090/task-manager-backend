<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Entities\Role;

class User extends Model
{
    use HasApiTokens, HasFactory;

    protected $guarded = [];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
