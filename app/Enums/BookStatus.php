<?php

namespace App\Enums;

enum BookStatus: int
{
    case WAIT_FOR_APPROVE = 0;
    case BEFORE_START = 1;
    case STARTED = 2;
    case FINISHED = 3;

    /**
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            self::WAIT_FOR_APPROVE => __('views.profile.booking_status.wait_for_approve'),
            self::BEFORE_START => __('views.profile.booking_status.before_start'),
            self::STARTED => __('views.profile.booking_status.started'),
            self::FINISHED => __('views.profile.booking_status.finished'),
        };
    }
}
