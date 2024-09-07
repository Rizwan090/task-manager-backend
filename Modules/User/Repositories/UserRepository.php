<?php

namespace Modules\User\Repositories;

use Modules\User\Contracts\Repositories\UserRepositoryContract;
use Modules\User\Entities\User;

class UserRepository implements UserRepositoryContract
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
