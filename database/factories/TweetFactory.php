<?php

use App\Quote;
use Faker\Generator as Faker;

$factory->define(App\Tweet::class, function (Faker $faker) {
    return [
        'quote_id' => function () {
            return factory(Quote::class)->create()->id;
        },
        'tweet_id' => $faker->randomNumber(5),
        'retweet_count' => 0,
        'favorite_count' => 0,
    ];
});
