<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;
use Thujohn\Twitter\Facades\Twitter;

class RefreshTweets extends Command
{
    /**
     * @var string
     */
    protected $signature = 'tweets:refresh';

    /**
     * @var string
     */
    protected $description = 'Refresh all Tweets ';

    public function handle()
    {
        Tweet::inThePastWeek()
            ->get()
            ->each(function ($local) {
                $tweet = Twitter::getTweet($local->tweet_id);

                $local->retweet_count = $tweet->retweet_count;
                $local->favorite_count = $tweet->favorite_count;
                $local->save();
            });
    }
}
