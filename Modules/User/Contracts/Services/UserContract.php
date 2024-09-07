<?php

namespace Modules\User\Contracts\Services;

use Modules\User\Entities\User;

interface UserContract
{
    public function findByEmail(string $email): ?User;
    public function checkUserPassword(User $user, string $password): bool;
}
