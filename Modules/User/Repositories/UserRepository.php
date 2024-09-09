<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\User\Contracts\Repositories\UserRepositoryContract;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryContract
{
    /**
     * Find a user by email.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Update an existing user.
     *
     * @param User $user
     * @param string|null $name
     * @param string|null $email
     * @param string|null $password
     * @return User
     */
    public function updateUser(User $user, ?string $name, ?string $email, ?string $password): User
    {
        if ($name !== null) {
            $user->name = $name;
        }

        if ($email !== null) {
            $user->email = $email;
        }

        if (!empty($password)) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return $user;
    }


    /**
     * Find a user by their ID.
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Delete a user.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function getAll(): Collection
    {
        return User::all();
    }
}
