<?php

namespace Modules\Core\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\Core\Entities\Role;

interface RoleRepositoryContract
{
    /**
     * @param string $name
     * @return Role
     */
    public function create(string $name,): Role;

    /**
     * @return Collection|null
     */
    public function getRoles(): ?Collection;

    /**
     * @param string $id
     * @return Role|null
     */
    public function findById(string $id): Role|null;

    /**
     * @param string $strUuid
     * @return Role|null
     */
    public function findByUuid(string $strUuid): Role|null;

    /**
     * @param Role $role
     * @return bool
     */
    public function deleteRole(Role $role): bool;

    /**
     * @param Role $objRole
     * @param string|null $strName
     * @return Role
     */
    public function updateRole(Role $objRole, ?string $strName = null,): Role;

    public function getRoleByName(string $name): ?string;


    public function assignPermissions(Role $objRole , array $arrPermissions): Role|null;
}
