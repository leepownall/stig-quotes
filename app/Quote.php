<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Quote extends Model
{
    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    public function getHasBeenTweetedAttribute(): bool
    {
        return !is_null($this->tweets->last());
    }

    public function getLastTweetedAtAttribute()
    {
        $last = $this->tweets->last();

        return $last
            ? "<a href='https://twitter.com/stigquotes/status/{$last->tweet_id}' target='_blank'>Last tweeted {$last->created_at->diffForHumans()}</a>"
            : '';
    }
}
