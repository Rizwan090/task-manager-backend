<?php

namespace Modules\Core\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\Core\Entities\Permission;
use Modules\User\Enum\UserType;


interface PermissionRepositoryContract
{

    /**
     * @param string $name
     * @return Permission
     */
    public function create(string   $name,): Permission;

    /**
     * @return Collection|null
     */
    public function getPermissions(): ?Collection;

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
     * @return bool
     */
    public function deletePermission(Permission $permission): bool;

    /**
     * @param Permission $objPermission
     * @param string|null $strName
     */
    public function updatePermission(Permission $objPermission, ?string $strName = null): Permission;


}
