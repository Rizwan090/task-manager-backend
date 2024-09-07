<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Core\Entities\Role;
use Modules\User\Enum\UserType;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        $roles = [
            UserType::USER->value,
            UserType::ADMIN->value,

        ];
        foreach ($roles as $role) {
            Role::create([
                "name" => $role,
                "role_uuid" => Str::uuid(),
            ]);
        }
    }
}
