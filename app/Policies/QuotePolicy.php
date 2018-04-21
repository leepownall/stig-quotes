<?php

namespace App\Policies;

use App\Quote;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin) {
            return true;
        }
    }

    public function delete(User $user, Quote $quote): bool
    {
        return $user->id === optional($quote->user)->id;
    }

    public function edit(User $user): bool
    {
        return $user->isAdmin;
    }
}
