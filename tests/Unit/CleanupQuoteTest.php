<?php

namespace Tests\Unit;

use App\Quote;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CleanupQuoteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test **/
    public function it_removes_quote_not_of_acceptable_length()
    {
        factory(Quote::class)->create(['body' => 'Some say hello']);

        $this->assertCount(1, Quote::all());

        Artisan::call('quote:cleanup');

        $this->assertCount(0, Quote::all());
    }

    /** @test **/
    public function it_removes_quote_that_contains_swearing()
    {
        factory(Quote::class)->create(['body' => 'Some say fuck fuck fuck fuck fuck fuck']);

        $this->assertCount(1, Quote::all());

        Artisan::call('quote:cleanup');

        $this->assertCount(0, Quote::all());
    }

    /** @test **/
    public function it_removes_quote_that_try_to_at_an_account()
    {
        factory(Quote::class)->create(['body' => 'Some say I hope this gets tweeted out @jeff']);

        $this->assertCount(1, Quote::all());

        Artisan::call('quote:cleanup');

        $this->assertCount(0, Quote::all());
    }

    /** @test **/
    public function it_removes_duplicate_quotes()
    {
        factory(Quote::class)->create(['body' => 'Some say he really likes jello and peanut butter']);
        factory(Quote::class)->create(['body' => 'Some say he really likes jello and peanut butter']);

        $this->assertCount(2, Quote::all());

        Artisan::call('quote:cleanup');

        $this->assertCount(1, Quote::all());
    }

    /** @test **/
    public function it_removes_quotes_that_are_too_long()
    {
        $this->setUpFaker();

        factory(Quote::class)->create([
            'body' => $this->faker->sentence(200),
        ]);

        $this->assertCount(1, Quote::all());

        Artisan::call('quote:cleanup');

        $this->assertCount(0, Quote::all());
    }
}
