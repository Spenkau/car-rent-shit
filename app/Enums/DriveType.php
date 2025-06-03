<?php

namespace App\Enums;

enum DriveType: int
{
    case FRONT = 1;
    case REAR = 2;
    case AWD = 3;

    /**
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            self::FRONT => 'Передний привод',
            self::REAR => 'Задний привод',
            self::AWD => 'Полный привод',
        };
    }
}
