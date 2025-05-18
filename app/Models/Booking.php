<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Booking extends Model
{
    /**
     * @var string
     */
    protected $table = 'bookings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'start_date',
        'end_date',
        'status',
        'payment_status',
        'rating',
        'phone' // в случае если пользователь  хочет сделать заказ на другой, отличный от указанного при регистрации, номер
    ];

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
