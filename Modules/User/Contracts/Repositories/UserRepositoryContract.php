<?php

namespace Modules\User\Contracts\Repositories;

use Modules\User\Entities\User;

interface UserRepositoryContract
{
    public function findByEmail(string $email): ?User;

    public function create(array $data): User;

    public function updateUser(User $user, string $name, string $email, ?string $password): User;

    /**
     * Find a user by their ID.
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;
    public function delete(User $user): bool;
}
