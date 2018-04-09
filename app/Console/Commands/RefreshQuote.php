<?php

namespace App\Console\Commands;

use App\Quote;
use Illuminate\Console\Command;
use Thujohn\Twitter\Facades\Twitter;

class RefreshQuote extends Command
{
    /**
     * @var string
     */
    protected $signature = 'quote:refresh {quote}';

    /**
     * @var string
     */
    protected $description = 'Refresh all Tweets associated to a Quote.';

    public function handle(): void
    {
        Quote::findOrFail($this->argument('quote'))
            ->tweets
            ->each(function ($local) {
                $tweet = Twitter::getTweet($local->tweet_id);

                $local->retweet_count = $tweet->retweet_count;
                $local->favorite_count = $tweet->favorite_count;
                $local->save();
            });
    }
}
