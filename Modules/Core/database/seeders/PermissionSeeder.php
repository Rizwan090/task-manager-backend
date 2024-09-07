<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Enum\Settings;
use Modules\Core\Contracts\Repositories\PermissionRepositoryContract;
use Modules\Core\Entities\Role;
use Modules\Core\Enum\Permissions\User as UserPermission;
use Modules\Core\Enum\Permissions\Role as RolePermission;
use Modules\Core\Enum\Permissions\Permission as PermissionPermission;

use Modules\User\Enum\UserType;

class PermissionSeeder extends Seeder
{

    public function __construct(
        private readonly PermissionRepositoryContract $objPermissionRepository,
    )
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $permissions = [
            UserPermission::GET_USERS->value,
            UserPermission::GET_ADMINS->value,
            UserPermission::CREATE_USERS->value,
            UserPermission::CREATE_ADMINS->value,
            UserPermission::UPDATE_USERS->value,
            UserPermission::UPDATE_ADMINS->value,
            UserPermission::DELETE_USERS->value,
            UserPermission::DELETE_ADMINS->value,
            UserPermission::UPDATE_PERMISSIONS->value,



            //RolePermissions
            RolePermission::GET_ROLES->value,
            RolePermission::SHOW_ROLE->value,
            RolePermission::STORE_ROLE->value,
            RolePermission::DELETE_ROLE->value,
            RolePermission::UPDATE_ROLE->value,
            PermissionPermission::GET_PERMISSIONS->value,
            PermissionPermission::SHOW_PERMISSION->value,
            PermissionPermission::STORE_PERMISSION->value,
            PermissionPermission::DELETE_PERMISSION->value,
            PermissionPermission::UPDATE_PERMISSION->value,


        ];
        foreach ($permissions as $permission) {
            $this->objPermissionRepository->create(
                $permission,
            );
        }
        $permissions = $this->objPermissionRepository->getPermissions();
        $permissionIds = $permissions->pluck('id')->toArray();
        $role = Role::whereName(UserType::ADMIN->value)->first();
        $role->permissions()->sync($permissionIds);
    }
}
