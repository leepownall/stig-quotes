<?php

namespace Tests\Feature;

use App\Quote;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuoteDeleteTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function visitor_cannot_see_delete_button()
    {
        $quote = factory(Quote::class)->create();

        $this
            ->visitRoute('quotes.index')
            ->within("#quote-{$quote->id}", function () use ($quote) {
               $this->seeText($quote->body)
                   ->dontSeeText('Delete');
            });
    }

    /** @test **/
    public function user_can_see_delete_button_for_their_quote()
    {
        $quoteA = factory(Quote::class)->create();
        $quoteB = factory(Quote::class)->create();

        $this
            ->actingAs($quoteB->user)
            ->visitRoute('quotes.index')
            ->dontSeeElement('form', ['action' => route('quotes.destroy', $quoteA)])
            ->seeElement('form', ['action' => route('quotes.destroy', $quoteB)]);
    }

    /** @test **/
    public function user_can_delete_their_own_quote()
    {
        $quoteA = factory(Quote::class)->create();
        $quoteB = factory(Quote::class)->create();

        $this
            ->actingAs($quoteB->user)
            ->visitRoute('quotes.index')
            ->within("#quote-{$quoteB->id}", function () {
                $this->press('Delete');
            })
            ->seeText('Quote has been deleted.')
            ->assertSoftDeleted('quotes', [
                'id' => $quoteB->id,
            ]);

    }

    /** @test **/
    public function user_cannot_delete_a_quote_they_do_not_own()
    {
        $quote = factory(Quote::class)->create();
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->visitRoute('quotes.index')
            ->post(route('quotes.destroy', $quote))
            ->dontSeeText('Quote has been deleted.')
            ->seeInDatabase('quotes', [
                'id' => $quote->id,
            ]);
    }

    /** @test **/
    public function admin_can_delete_any_quote()
    {
        $quote = factory(Quote::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this
            ->actingAs($admin)
            ->visitRoute('quotes.index')
            ->press('Delete')
            ->seeText('Quote has been deleted.')
            ->seeInDatabase('quotes', [
                'id' => $quote->id,
            ]);
    }
}
