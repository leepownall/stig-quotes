<?php

namespace Tests\Feature;

use App\Quote;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function user_can_delete_account()
    {
        $user = factory(User::class)->create();

        $quote = factory(Quote::class)->create(['user_id' => $user->id]);

        $this
            ->seeInDatabase('quotes', [
                'id' => $quote->id,
                'user_id' => $user->id,
            ]);

        $this
            ->actingAs($user)
            ->visitRoute('settings.index')
            ->seeText('Delete Account')
            ->click('Delete Account')
            ->seeRouteIs('quotes.index')
            ->seeInDatabase('quotes', [
                'id' => $quote->id,
                'user_id' => null,
            ])
            ->dontSeeInDatabase('users', [
                'id' => $user->id,
            ]);
    }
}
