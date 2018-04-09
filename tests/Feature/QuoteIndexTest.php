<?php

namespace Tests\Feature;

use App\Quote;
use App\Tweet;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuoteIndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /** @test **/
    public function visitor_can_view_quotes()
    {
        $quote = factory(Quote::class)->create(['user_id' => null]);

        $this
            ->visitRoute('quotes.index')
            ->dontSeeElement('.card-header')
            ->within('.card-body', function () use ($quote) {
                $this->seeText($quote->body);
            });
    }

    /** @test **/
    public function visitor_can_view_quote_creator_details()
    {
        $quote = factory(Quote::class)->create();

        $this
            ->visitRoute('quotes.index')
            ->within('.card-header', function () use ($quote) {
                $this
                    ->seeText($quote->user->name)
                    ->seeLink("@{$quote->user->nickname}", "https://twitter.com/{$quote->user->nickname}");
            })
            ->within('.card-body', function () use ($quote) {
                $this->seeText($quote->body);
            });
    }

    /** @test **/
    public function visitor_can_view_when_quote_was_last_tweeted()
    {
        Carbon::setTestNow('March 1, 2018 3:00pm');

        $tweet = factory(Tweet::class)->create();

        Carbon::setTestNow('March 1, 2018 4:00pm');

        $this
            ->visitRoute('quotes.index')
            ->within('.card-footer', function () use ($tweet) {
                $this->seeLink('Last tweeted 1 hour ago', "https://twitter.com/stigquotes/status/{$tweet->tweet_id}");
            });
    }
}
