<?php

namespace Tests\Unit;

use App\Tweet;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_can_get_tweets_in_past_week()
    {
        Carbon::setTestNow('April 4, 2018 2:00pm');

        factory(Tweet::class)->create();

        Carbon::setTestNow('April 11, 2018 12:00am');
        $this->assertCount(1, Tweet::inThePastWeek()->get());

        Carbon::setTestNow('April 12, 2018 12:00am');
        $this->assertCount(0, Tweet::inThePastWeek()->get());
    }
}
