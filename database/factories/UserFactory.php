<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(User::class, function (Faker $faker) {
    return [
        'twitter_id' => 1,
        'token' => str_random(8),
        'token_secret' => str_random(),
        'name' => $faker->name,
        'nickname' => $faker->userName,
        'avatar' => $faker->imageUrl,
        'remember_token' => str_random(10),
    ];
});

$factory->state(User::class, 'admin', function () {
    return [
        'admin_at' => Carbon::now(),
    ];
});
