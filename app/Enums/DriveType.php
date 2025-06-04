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
            self::FRONT => __('views.cars.drive_options.front'),
            self::REAR => __('views.cars.drive_options.rear'),
            self::AWD => __('views.cars.drive_options.electric'),
        };
    }
}
