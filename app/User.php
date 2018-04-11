<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'twitter_id',
        'token',
        'token_secret',
        'name',
        'nickname',
        'email',
        'avatar',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'token',
        'token_secret',
    ];

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }
}
