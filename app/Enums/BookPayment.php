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
            self::NOT_PAID => 'Оплачен',
            self::PAID => 'Не оплачен'
        };
    }
}
