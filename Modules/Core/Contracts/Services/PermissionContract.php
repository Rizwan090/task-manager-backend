<?php

namespace Modules\Core\Contracts\Services;

use Illuminate\Support\Collection;
use Modules\Core\DataTransfer\Requests\PermissionDTO;
use Modules\Core\Entities\Permission;

interface PermissionContract
{

    /**
     * @param PermissionDTO $permissionCreateDTO
     * @return Permission
     */
    public function create(PermissionDTO $permissionCreateDTO): Permission;

    /**
     * @return Collection
     */
    public function get() :Collection;

    /**
     * @param string $id
     * @return Permission|null
     */
    public function findById(string $id): ?Permission;

    /**
     * @param string $strUuid
     * @return Permission|null
     */
    public function findByUuid(string $strUuid): ?Permission;

    /**
     * @param Permission $permission
     * @return bool|null
     */
    public function delete(Permission $permission): ?bool;


    /**
     * @param Permission $objPermission
     * @param PermissionDTO $updatePermissionDTO
     * @return Permission
     */
    public function update(Permission $objPermission , PermissionDTO $updatePermissionDTO): Permission;

}
