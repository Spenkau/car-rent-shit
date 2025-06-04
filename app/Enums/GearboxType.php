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
            self::MANUAL => __('views.cars.gearbox_options.manual'),
            self::AUTOMATIC => __('views.cars.gearbox_options.automatic'),
            self::AUTOMATED_MANUAL => __('views.cars.gearbox_options.robotic'),
            self::CONTINUOUSLY_VARIABLE => __('views.cars.gearbox_options.variator'),
            self::DUAL_CLUTCH => __('views.cars.gearbox_options.dual_clutch'),
            self::SEMI_AUTOMATIC => __('views.cars.gearbox_options.semiautomatic'),
            self::SEQUENTIAL => __('views.cars.gearbox_options.sequential'),
        };
    }

    /**
     * @return string
     */
    public function shortName(): string
    {
        return match ($this) {
            self::MANUAL => __('views.cars.gearbox_options.manual'),
            self::AUTOMATIC => __('views.cars.gearbox_options.automatic'),
            self::AUTOMATED_MANUAL => __('views.cars.gearbox_options.robotic'),
            self::CONTINUOUSLY_VARIABLE => __('views.cars.gearbox_options.variator'),
            self::DUAL_CLUTCH => __('views.cars.gearbox_options.dual_clutch'),
            self::SEMI_AUTOMATIC => __('views.cars.gearbox_options.semiautomatic'),
            self::SEQUENTIAL => __('views.cars.gearbox_options.sequential'),
        };
    }
}
