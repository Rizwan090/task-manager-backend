<?php

namespace Modules\User\Enum\Response;

enum ResponseCode: int
{
    // Default Errors
    case SUCCESS = 1;
    case DEFAULT_ERROR = 1000;

    // Platform Errors
    case VALIDATION_ERROR = 1002;

    // Authentication Error
    case AUTHENTICATION_ERROR = 1100;
    case PASSWORD_MISMATCH_ERROR = 1101;

    //Cache Errors
    case CACHE_CONNECTION = 1030;


    public function message(): string
    {
        return match ($this) {
            ResponseCode::SUCCESS => "Success.",
            ResponseCode::AUTHENTICATION_ERROR => "Unauthenticated.",
            ResponseCode::PASSWORD_MISMATCH_ERROR => "Passwords Mismatch.",
            ResponseCode::VALIDATION_ERROR => "Validation Error.",
            ResponseCode::CACHE_CONNECTION => "Invalid Cache Connection.",
            default => "Something Went Wrong.",
        };
    }
}
