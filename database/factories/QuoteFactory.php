<?php

use App\Quote;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'body' => $faker->words(rand(5, 20), true),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->state(Quote::class, 'deleted', function () {
    return [
        'deleted_at' => Carbon::now(),
    ];
});
