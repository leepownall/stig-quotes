<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();

        $user = User::firstOrCreate(
            ['twitter_id' => $user->id],
            [
                'twitter_id' => $user->id,
                'token' => $user->token,
                'token_secret' => $user->tokenSecret,
                'name' => $user->getName(),
                'nickname' => $user->getNickname(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect()->route('quotes.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('quotes.index');
    }
}
