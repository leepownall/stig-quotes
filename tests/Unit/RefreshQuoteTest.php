<?php

namespace Tests\Unit;

use App\Quote;
use App\Tweet;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Thujohn\Twitter\Facades\Twitter;

class RefreshQuoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_does_nothing_if_it_has_no_tweets()
    {
        $quote = factory(Quote::class)->create();

        Twitter::shouldReceive('getTweet')->never();

        Artisan::call('quote:refresh', ['quote' => $quote->id]);
    }

    /** @test **/
    public function it_updates_retweet_and_favorite_count()
    {
        $quote = factory(Quote::class)->create();
        $tweet = factory(Tweet::class)->create([
            'quote_id' => $quote->id,
            'retweet_count' => 1,
            'favorite_count' => 2,
        ]);

        Twitter::shouldReceive('getTweet')
            ->once()
            ->andReturn((object) [
                'retweet_count' => 5,
                'favorite_count' => 6,
            ]);

        Artisan::call('quote:refresh', ['quote' => $quote->id]);

        $this->seeInDatabase('tweets', [
            'id' => $tweet->id,
            'retweet_count' => 5,
            'favorite_count' => 6,
        ]);
    }
}
