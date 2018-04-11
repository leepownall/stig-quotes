<?php

namespace Tests\Unit;

use App\Quote;
use App\Tweet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Thujohn\Twitter\Facades\Twitter;

class RefreshTweetsTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_refreshes_tweets_within_a_week()
    {
        Carbon::setTestNow('April 3, 2018 12:00am');

        $quote = factory(Quote::class)->create();

        $tweetA = factory(Tweet::class)->create([
            'quote_id' => $quote->id,
            'retweet_count' => 1,
            'favorite_count' => 2,
        ]);

        Carbon::setTestNow('April 11, 2018 12:00am');

        $tweetB = factory(Tweet::class)->create([
            'quote_id' => $quote->id,
            'retweet_count' => 2,
            'favorite_count' => 4,
        ]);

        Twitter::shouldReceive('getTweet')
            ->never()
            ->with($tweetA->tweet_id);

        Twitter::shouldReceive('getTweet')
            ->once()
            ->with($tweetB->tweet_id)
            ->andReturn((object) [
                'retweet_count' => 5,
                'favorite_count' => 6,
            ]);

        Artisan::call('tweets:refresh');

        $this
            ->seeInDatabase('tweets', [
                'id' => $tweetA->id,
                'retweet_count' => 1,
                'favorite_count' => 2,
            ])
            ->seeInDatabase('tweets', [
                'id' => $tweetB->id,
                'retweet_count' => 5,
                'favorite_count' => 6,
            ]);
    }
}
