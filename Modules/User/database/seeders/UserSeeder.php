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
        // Disable foreign key checks to avoid constraint issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the users table
        DB::table('users')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create or get the admin role
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
        ], [
            'role_uuid' => Str::uuid(),
        ]);

        // Insert a new user
        DB::table('users')->insert([
            'name' => 'Admin234',
            'email' => 'codionslab@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role_id' => $adminRole->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
