<?php

namespace Modules\Core\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\User\DataTransfer\Requests\AssignPermissionDTO;
use Modules\Core\DataTransfer\Requests\RoleDTO;
use Modules\Core\Entities\Role;

interface RoleContract
{
    /**
     * @param RoleDTO $roleCreateDTO
     * @return Role
     */
    public function create(RoleDTO $roleCreateDTO): Role;

    /**
     * @return Collection
     */
    public function get() :Collection;

    /**
     * @param string $id
     * @return Role|null
     */
    public function findById(string $id): Role|null;

    /**
     * @param string $id
     * @return Role|null
     */
    public function findByUuId(string $strUuid): Role|null;

    /**
     * @param Role $role
     * @return bool|null
     */
    public function delete(Role $role): ?bool;


    /**
     * @param Role $objRole
     * @param RoleDTO $updateRoleDTO
     * @return Role
     */
    public function update(Role $objRole , RoleDTO $updateRoleDTO): Role;


    /**
     * @param Role $objRole
     * @param AssignPermissionDTO $assignPermissionDTO
     * @return Role|null
     */
    public function assignPermissions(Role $objRole , AssignPermissionDTO $assignPermissionDTO): Role|null;
}
