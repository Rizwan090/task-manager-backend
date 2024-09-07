<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Core\Entities\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        // Check if 'admin' role exists, if not create one
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
        ], [
            'role_uuid' => Str::uuid(),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin234',
            'email' => 'codionslab@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'is_active' => true,
            'role_id' => $adminRole->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
