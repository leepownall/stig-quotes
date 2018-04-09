<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'twitter_id' => 1,
        'token' => str_random(8),
        'token_secret' => str_random(),
        'name' => $faker->name,
        'nickname' => $faker->userName,
        'email' => $faker->safeEmail,
        'avatar' => $faker->imageUrl,
        'remember_token' => str_random(10),
    ];
});
