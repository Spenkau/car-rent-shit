<?php

namespace App\Enums;

enum BookPayment: int
{
    case NOT_PAID = 0;
    case PAID = 1;

    /**
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            self::NOT_PAID =>  __('views.profile.payment_status.not_paid'),
            self::PAID =>  __('views.profile.payment_status.paid')
        };
    }
}
