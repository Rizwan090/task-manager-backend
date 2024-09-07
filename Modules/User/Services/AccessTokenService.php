<?php

namespace Modules\User\Services;

use Laravel\Sanctum\PersonalAccessToken;
use Modules\User\Entities\User;
use Illuminate\Support\Collection;
use Modules\User\Contracts\Services\AccessTokenContract;

final class AccessTokenService implements AccessTokenContract
{
    public function createAuthToken(User $objUser): string
    {
        $strTokenName = 'your-token-name';
        return $objUser->createToken($strTokenName)->plainTextToken;
    }

    public function revokeToken(PersonalAccessToken $objToken): bool
    {
        return $objToken->delete();
    }

    public function getCurrentToken(User $objUser): PersonalAccessToken
    {
        return $objUser->currentAccessToken();
    }

    public function getUsersTokens(User $objUser): Collection
    {
        return $objUser->tokens;
    }
}
