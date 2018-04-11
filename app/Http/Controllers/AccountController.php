<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function destroy()
    {
        $user = auth()->user();

        $user
            ->quotes
            ->each(function ($quote) {
                $quote->user_id = null;
                $quote->save();
            });

        Auth::logout();

        $user->forceDelete();

        session()->flash('status', '<strong>Account deleted!</strong> Your account has been successfully deleted.');

        return redirect()
            ->route('quotes.index');
    }
}
