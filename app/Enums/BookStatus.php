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
            self::WAIT_FOR_APPROVE => 'Ожидает подтверждения',
            self::BEFORE_START => 'Подтверждено',
            self::STARTED => 'Начат',
            self::FINISHED => 'Завершен',
        };
    }
}
