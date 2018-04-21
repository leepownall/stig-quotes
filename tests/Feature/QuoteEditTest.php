<?php

namespace Tests\Feature;

use App\Quote;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuoteEditTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function visitor_cannot_see_edit_button()
    {
        $quote = factory(Quote::class)->create();

        $this
            ->visitRoute('quotes.index')
            ->dontSeeElement('a', ['href' => route('quotes.edit', $quote)]);
    }

    /** @test **/
    public function visitor_cannot_edit_quote()
    {
        $quote = factory(Quote::class)->create();

        $this
            ->visitRoute('quotes.edit', $quote)
            ->seeRouteIs('quotes.index');
    }

    /** @test **/
    public function admin_can_see_edit_button()
    {
        $quote = factory(Quote::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this
            ->actingAs($admin)
            ->visitRoute('quotes.index')
            ->seeElement('a', ['href' => route('quotes.edit', $quote)]);
    }

    /** @test **/
    public function admin_can_edit_quote()
    {
        $quote = factory(Quote::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this
            ->actingAs($admin)
            ->visitRoute('quotes.edit', $quote)
            ->seeInField('quote', $quote->body)
            ->type('Some say that an admin can edit quotes', 'quote')
            ->press('Submit Edit')
            ->seeRouteIs('quotes.index')
            ->seeInDatabase('quotes', [
                'id' => $quote->id,
                'body' => 'Some say that an admin can edit quotes',
            ]);
    }
}
