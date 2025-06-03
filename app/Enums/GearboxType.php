<?php

namespace App\Enums;

enum GearboxType: int
{
    case MANUAL = 1;
    case AUTOMATIC = 2;
    case AUTOMATED_MANUAL = 3;
    case CONTINUOUSLY_VARIABLE = 4;
    case DUAL_CLUTCH = 5;
    case SEMI_AUTOMATIC = 6;
    case SEQUENTIAL = 7;

    /**
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            self::MANUAL => 'Механическая коробка передач',
            self::AUTOMATIC => 'Автоматическая коробка передач',
            self::AUTOMATED_MANUAL => 'Роботизированная механика',
            self::CONTINUOUSLY_VARIABLE => 'Вариатор',
            self::DUAL_CLUTCH => 'Коробка с двумя сцеплениями',
            self::SEMI_AUTOMATIC => 'Полуавтоматическая коробка',
            self::SEQUENTIAL => 'Секвентальная коробка',
        };
    }

    /**
     * @return string
     */
    public function shortName(): string
    {
        return match ($this) {
            self::MANUAL => 'механика',
            self::AUTOMATIC => 'автомат',
            self::AUTOMATED_MANUAL => 'робот',
            self::CONTINUOUSLY_VARIABLE => 'вариатор',
            self::DUAL_CLUTCH => 'двойное сцепление',
            self::SEMI_AUTOMATIC => 'полуавтомат',
            self::SEQUENTIAL => 'секвентал',
        };
    }
}
