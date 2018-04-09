<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
}
