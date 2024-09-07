<?php

namespace Modules\User\Contracts\Services;

use Modules\User\Entities\User;
use Illuminate\Support\Collection;
use Laravel\Sanctum\PersonalAccessToken;

interface AccessTokenContract
{
    /**
     * @param User $user
     * @return PersonalAccessToken
     */
    public function getCurrentToken(User $user): PersonalAccessToken;

    /**
     * @param User $user
     * @return Collection<int, PersonalAccessToken>
     */
    public function getUsersTokens(User $user): Collection;

    /**
     * @param User $user
     * @return string
     */
    public function createAuthToken(User $user): string;

    /**
     * @param PersonalAccessToken $token
     * @return bool
     */
    public function revokeToken(PersonalAccessToken $token): bool;
}
