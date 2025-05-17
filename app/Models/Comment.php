<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'body',
        'image',
        'is_approved',
        'user_id',
        'commentable_id',
        'commentable_type'
    ];

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return Builder
     */
    public function scopeApproved($query): Builder
    {
        return $query->where('is_approved', true);
    }
}
