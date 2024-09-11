<?php

namespace Modules\User\Enum;

enum status: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case TESTING = 'testing';
    case HOLD = 'hold';
    case COMPLETED = 'completed';

    /**
     * Get all the values of the enum.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
