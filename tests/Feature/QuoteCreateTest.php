<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuoteCreateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test **/
    public function visitor_must_enter_more_than_5_characters_to_create_a_quote()
    {
        $this
            ->visitRoute('quotes.index')
            ->type('aa', 'quote')
            ->press('Submit')
            ->within('.alert-danger', function () {
                $this->seeText('The quote must be at least 5 characters.');
            })
            ->dontSeeInDatabase('quotes', [
                'body' => 'aa',
                'user_id' => null,
            ]);
    }

    /** @test **/
    public function quote_cannot_be_more_than_280_characters()
    {
        $this->setUpFaker();

        $quote = $this->faker->sentence(300);

        $this
            ->visitRoute('quotes.index')
            ->type($quote, 'quote')
            ->press('Submit')
            ->within('.alert-danger', function () {
                $this->seeText('The quote may not be greater than 280 characters.');
            })
            ->dontSeeInDatabase('quotes', [
                'body' => $quote,
                'user_id' => null,
            ]);
    }

    /** @test **/
    public function visitor_can_create_a_quote()
    {
        $this
            ->visitRoute('quotes.index')
            ->type('his favourite colour is blur', 'quote')
            ->press('Submit')
            ->seeInDatabase('quotes', [
                'body' => 'Some say his favourite colour is blur',
                'user_id' => null,
            ]);
    }

    /** @test **/
    public function quote_is_associated_to_authenticated_user()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->visitRoute('quotes.index')
            ->type('his favourite colour is blur', 'quote')
            ->press('Submit')
            ->seeInDatabase('quotes', [
                'body' => 'Some say his favourite colour is blur',
                'user_id' => $user->id,
            ]);
    }
}
