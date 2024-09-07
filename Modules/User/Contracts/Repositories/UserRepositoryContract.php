<?php

namespace Modules\User\Contracts\Repositories;

use Modules\User\Entities\User;

interface UserRepositoryContract
{
    public function findByEmail(string $email): ?User;
    public function create(array $data): User;
    public function delete(User $user): bool;
}
