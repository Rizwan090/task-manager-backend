<?php

namespace Modules\Core\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Core\Contracts\Repositories\PermissionRepositoryContract;
use Modules\Core\Entities\Permission;

readonly class PermissionRepository implements PermissionRepositoryContract
{
    public function __construct(private readonly Permission $model) {}

    /**
     * Create a new permission.
     *
     * @param string $name
     * @return Permission
     */
    public function create(string $name): Permission
    {
        return $this->model->create([
            'name' => $name,
            'permission_uuid' => Str::uuid(),
        ]);
    }

    /**
     * Get all permissions.
     *
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        return $this->model->latest()->get();
    }

    /**
     * Find a permission by ID.
     *
     * @param string $id
     * @return Permission|null
     */
    public function findById(string $id): ?Permission
    {
        return $this->model->find($id);
    }

    /**
     * Delete a permission.
     *
     * @param Permission $permission
     * @return bool
     */
    public function deletePermission(Permission $permission): bool
    {
        return $permission->delete();
    }

    /**
     * Update an existing permission.
     *
     * @param Permission $permission
     * @param string|null $name
     * @return Permission
     */
    public function updatePermission(Permission $permission, ?string $name = null): Permission
    {
        if ($name && $permission->name !== $name) {
            $permission->name = $name;
            $permission->save();
        }

        return $permission;
    }

    /**
     * Find a permission by UUID.
     *
     * @param string $uuid
     * @return Permission|null
     */
    public function findByUuid(string $uuid): ?Permission
    {
        return $this->model->where('permission_uuid', $uuid)->first();
    }
}
