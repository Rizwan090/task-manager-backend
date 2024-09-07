<?php

namespace Modules\User\Services;

use Modules\User\Contracts\Repositories\UserRepositoryContract;
use Modules\User\Contracts\Services\UserContract;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class UserService implements UserContract
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    ) {}

    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function checkUserPassword(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }
}
