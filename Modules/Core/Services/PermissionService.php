<?php

namespace Modules\Core\Services;

use Illuminate\Support\Collection;
use Modules\Core\Contracts\Repositories\PermissionRepositoryContract;
use Modules\Core\Contracts\Services\PermissionContract;
use Modules\Core\Entities\Permission;
use Modules\Core\DataTransfer\Requests\PermissionDTO;
use Modules\User\Enum\UserType;

readonly class PermissionService implements PermissionContract
{
    public function __construct(
        //Repositories
        private PermissionRepositoryContract $objPermissionRepository,
    ) {}

    /**
     * @param PermissionDTO $createPermissionDTO
     * @return Permission
     */
    public function create(PermissionDTO $createPermissionDTO): Permission
    {
        return $this->objPermissionRepository->create(
            $createPermissionDTO->getName(),
            UserType::ADMIN->value
        );

    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->objPermissionRepository->getPermissions();
    }

    /**
     * @param string $id
     * @return Permission|null
     */
    public function findById(string $id): ?Permission
    {
        return $this->objPermissionRepository->findById($id);
    }

    public function delete(Permission $permission): ?bool
    {
        return $this->objPermissionRepository->deletePermission($permission);
    }

    /**
     * @param Permission $objPermission
     * @param PermissionDTO $updatePermissionDTO
     * @return Permission
     */
    public function update(Permission $objPermission, PermissionDTO $updatePermissionDTO): Permission
    {
        return $this->objPermissionRepository->updatePermission(
            $objPermission,
            $updatePermissionDTO->getName(),
        );
    }

    /**
     * @inheritDoc
     */
    public function findByUuid(string $strUuid): ?Permission
    {
        return $this->objPermissionRepository->findByUuid($strUuid);
    }
}
