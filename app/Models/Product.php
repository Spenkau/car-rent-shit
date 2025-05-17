<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    /**
     * @return HasOne
     */
    public function settings(): HasOne
    {
        return $this->hasOne(ProductSetting::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
