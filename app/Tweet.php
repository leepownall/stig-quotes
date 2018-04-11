<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Tweet extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'quote_id',
        'tweet_id',
        'retweet_count',
        'favorite_count',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeInThePastWeek(Builder $query): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse('-1 week')->startOfDay());
    }
}
