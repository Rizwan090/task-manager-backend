<?php

namespace Modules\Core\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Core\Contracts\Repositories\RoleRepositoryContract;
use Modules\Core\Entities\Role;
use Modules\User\Enum\UserType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class RoleRepository implements RoleRepositoryContract
{
    public function __construct(private Role $model) {}


    /**
     * @param string $name
     * @return Role
     */
    public function create(string $name): Role
    {
        $objQuery = $this->model->newQuery();
        $objRole = $objQuery->create([
            'name' => $name,
            'role_id' => Str::id(),
            'role_uuid' => Str::uuid()
        ]);
        return $objRole;
    }


    /**
     * @return Collection|null
     */
    public function getRoles(): ?Collection
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->whereNotIn("name" , [ UserType::ADMIN->value , UserType::USER->value] )->get();
    }

    /**
     * @param string $id
     * @return Role|null
     */
    public function findById(string $id): Role|null
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->find($id);
    }

    /**
     * @param Role $role
     * @return bool
     */
    public function deleteRole(Role $role): bool
    {
        return $role->delete();
    }


    /**
     * @param Role $objRole
     * @param string|null $strName
     * @return Role
     */
    public function updateRole(Role $objRole, ?string $strName = null): Role
    {
        if (is_string($strName) && $objRole->name !== $strName)
            $objRole->name = $strName;
        $objRole->update();
        return $objRole;
    }

    public function getRoleByName(string $strName): ?string
    {
        $objQuery = $this->model->newQuery();
        $role = $objQuery->whereName($strName)->first();

        if ($role) {
            return $role->id;
        }

        return null;
    }


    /**
     * @inheritDoc
     */
    public function findByUuid(string $strUuid): Role|null
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->whereRoleUuid($strUuid)->first();
    }

    public function assignPermissions(Role $objRole , array $arrPermissions): Role|null
    {
        $objRole->permissions()->sync($arrPermissions);
        $objRole->update();
        return $objRole;
    }
}
