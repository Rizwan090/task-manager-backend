<?php

namespace Modules\User\Services;

use Modules\User\Contracts\Repositories\UserRepositoryContract;
use Modules\User\Contracts\Services\UserContract;
use Modules\User\DataTransfer\Requests\SignUpDTO;
use Modules\User\DataTransfer\Requests\UpdateUserDTO;
use Modules\User\Entities\User;
use Modules\User\Enum\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

readonly class UserService implements UserContract
{
    public function __construct(
        private UserRepositoryContract $userRepository
    ) {}

    /**
     * Find a user by email.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * Check if the provided password matches the user's password.
     *
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function checkUserPassword(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }

    /**
     * Create a new user.
     *
     * @param SignUpDTO $signUpDTO
     * @param UserType $userType
     * @return User
     */
    public function create(SignUpDTO $signUpDTO, UserType $userType): User
    {
        $user = new User();
        $user->name = $signUpDTO->getName();
        $user->email = $signUpDTO->getEmail();
        $user->password = Hash::make($signUpDTO->getPassword());
        $user->role_id = $this->getRoleIdFromUserType($userType);
        $user->email_verified_at = now();
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
        return $this->userRepository->findById($id);
    }

    /**
     * Edit an existing user.
     *
     * @param User $objUser
     * @param UpdateUserDTO $updateUserDTO
     * @return User
     */
    public function edit(User $objUser, UpdateUserDTO $updateUserDTO): User
    {
        $objUser->name = $updateUserDTO->getName() ?? $objUser->name;
        $objUser->email = $updateUserDTO->getEmail() ?? $objUser->email;

        if ($updateUserDTO->getPassword()) {
            $objUser->password = Hash::make($updateUserDTO->getPassword());
        }

        $objUser->save();

        return $objUser;
    }


    /**
     * Get role ID based on user type.
     *
     * @param UserType $userType
     * @return int
     * @throws ModelNotFoundException
     */
    private function getRoleIdFromUserType(UserType $userType): int
    {
        return match ($userType) {
            UserType::ADMIN => 1,
            UserType::USER => 2,
            default => throw new ModelNotFoundException("User type not found."),
        };
    }

    /**
     * Get a user's profile by their ID.
     *
     * @param int $id
     * @return User|null
     * @throws ModelNotFoundException
     */
    public function getProfile(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * Update a user's profile by their ID.
     *
     * @param int $id
     * @param UpdateUserDTO $updateUserDTO
     * @return User
     * @throws ModelNotFoundException
     */
    public function updateProfile(int $id, UpdateUserDTO $updateUserDTO): User
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new ModelNotFoundException("User not found.");
        }

        $user->name = $updateUserDTO->getName() ?? $user->name;
        $user->email = $updateUserDTO->getEmail() ?? $user->email;

        if ($updateUserDTO->getPassword()) {
            $user->password = Hash::make($updateUserDTO->getPassword());
        }

        $user->save();

        return $user;
    }
    public function getAll(): iterable
    {
        return $this->userRepository->getAll();
    }

    public function delete(User $user): bool{
        return $user->delete();
    }
}
