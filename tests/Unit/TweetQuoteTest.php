<?php

namespace Tests\Unit;

use App\Quote;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Thujohn\Twitter\Facades\Twitter;

class TweetQuoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_saves_the_tweet()
    {
        $quote = factory(Quote::class)->create();

        Twitter::shouldReceive('postTweet')
            ->once()
            ->with(['status' => $quote->body])
            ->andReturn((object) ['id' => 1]);

        Artisan::call('quote:tweet');

        $this->seeInDatabase('tweets', [
            'tweet_id' => 1,
            'quote_id' => $quote->id,
            'retweet_count' => 0,
            'favorite_count' => 0,
        ]);
    }

    /** @test **/
    public function it_can_tweet_a_random_quote()
    {
        $quote = factory(Quote::class)->create();

        Twitter::shouldReceive('postTweet')
            ->once()
            ->with(['status' => $quote->body])
            ->andReturn((object) ['id' => 1]);

        Artisan::call('quote:tweet');
    }

    /** @test **/
    public function it_can_tweet_a_quote()
    {
        $quoteA = factory(Quote::class)->create();
        $quoteB = factory(Quote::class)->create();

        Twitter::shouldReceive('postTweet')
            ->once()
            ->with(['status' => $quoteB->body])
            ->andReturn((object) ['id' => 1]);

        Twitter::shouldReceive('postTweet')
            ->never()
            ->with(['status' => $quoteA->body]);

        Artisan::call('quote:tweet', ['quote' => $quoteB->id]);
    }

    /** @test **/
    public function it_throws_exception_if_no_quote_is_found()
    {
        $this->expectException(ModelNotFoundException::class);

        factory(Quote::class)->create();

        Artisan::call('quote:tweet', ['quote' => 232]);
    }
}
