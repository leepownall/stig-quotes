<?php

namespace App\Console\Commands;

use App\Quote;
use App\Tweet;
use Illuminate\Console\Command;
use Thujohn\Twitter\Facades\Twitter;

class TweetQuote extends Command
{
    /**
     * @var string
     */
    protected $signature = 'quote:tweet {quote?}';

    /**
     * @var string
     */
    protected $description = 'Tweet a quote';

    public function handle(): void
    {
        $quote = $this->getQuote();

        $tweet = Twitter::postTweet(['status' => $quote->body]);

        Tweet::create([
            'quote_id' => $quote->id,
            'tweet_id' => $tweet->id,
            'retweet_count' => 0,
            'favorite_count' => 0,
        ]);
    }

    private function getQuote(): Quote
    {
        if ($this->argument('quote') === null) {
            return Quote::inRandomOrder()->first();
        }

        return Quote::findOrFail($this->argument('quote'));
    }
}
