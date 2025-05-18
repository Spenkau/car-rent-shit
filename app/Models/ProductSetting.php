<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSetting extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'release_year',
        'gearbox_type',
        'engine_volume',
        'engine_type',
        'drive_type',
        'power',
        'mileage',
        'doors_count',
        'seats_count',
        'color',
        'vin',
        'is_customs_cleared',
        'is_crashed',
        'is_on_credit',
        'price',
        'model_3d',
        'image'
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
