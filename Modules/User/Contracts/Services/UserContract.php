<?php

namespace Modules\User\Contracts\Services;

use Modules\User\DataTransfer\Requests\SignUpDTO;
use Modules\User\DataTransfer\Requests\UpdateUserDTO;
use Modules\User\Entities\User;
use Modules\User\Enum\UserType;

interface UserContract
{
    public function findByEmail(string $email): ?User;

    public function checkUserPassword(User $user, string $password): bool;

    public function create(SignUpDTO $signUpDTO, UserType $userType): User;

    public function edit(User $objUser, UpdateUserDTO $updateUserDTO): User;

    public function getProfile(int $id): ?User;

    public function updateProfile(int $id, UpdateUserDTO $updateProfileDTO): User;
    public function getAll(): iterable;

    public function delete(User $user);


}
