<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MoreThanSomeSay implements Rule
{
    public function passes($attribute, $value): bool
    {
        $value = str_replace('Some say ', '', $value);

        return strlen($value) > 6;
    }

    public function message(): string
    {
        return 'The quote must be at least 5 characters.';
    }
}
