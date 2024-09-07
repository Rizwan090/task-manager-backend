<?php

namespace Modules\Core\Services;

use Illuminate\Support\Collection;
use Modules\User\DataTransfer\Requests\AssignPermissionDTO;
use Modules\Core\Contracts\Repositories\RoleRepositoryContract;
use Modules\Core\Contracts\Services\RoleContract;
use Modules\Core\Entities\Role;
use Modules\Core\DataTransfer\Requests\RoleDTO;

readonly class RoleService implements RoleContract
{
    public function __construct(
        //Repositories
        private RoleRepositoryContract $objRoleRepository,
    ) {}

    /**
     * @param RoleDTO $createRoleDTO
     * @return Role
     */
    public function create(RoleDTO $createRoleDTO): Role
    {
        return $this->objRoleRepository->create(
            $createRoleDTO->getName(),
        );

    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->objRoleRepository->getRoles();
    }

    /**
     * @param string $id
     * @return Role|null
     */
    public function findById(string $id): ?Role
    {
        return $this->objRoleRepository->findById($id);
    }

    public function delete(Role $role): ?bool
    {
        return $this->objRoleRepository->deleteRole($role);
    }

    /**
     * @param Role $objRole
     * @param RoleDTO $updateRoleDTO
     * @return Role
     */
    public function update(Role $objRole, RoleDTO $updateRoleDTO): Role
    {
        return $this->objRoleRepository->updateRole(
            $objRole,
            $updateRoleDTO->getName(),
        );
    }

    /**
     * @inheritDoc
     */
    public function findByUuId(string $strUuid): Role|null
    {
        return $this->objRoleRepository->findByUuid($strUuid);
    }

    public function assignPermissions(Role $objRole , AssignPermissionDTO $assignPermissionDTO): Role|null
    {
       return $this->objRoleRepository->assignPermissions($objRole , $assignPermissionDTO->getPermissions());
    }
}
