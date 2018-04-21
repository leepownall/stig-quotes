<?php

namespace App\Http\Requests;

use App\Rules\MoreThanSomeSay;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quote' => [
                'required',
                new MoreThanSomeSay,
                'max:280',
                Rule::unique('quotes', 'body')->ignore(request()->route('quote')->id),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'quote.required' => 'A quote is required.'
        ];
    }

    protected function prepareForValidation(): void
    {
        $quote = trim($this->quote);

        if (str_contains($quote, ['Some say', 'some say', 'Some Say']) === false) {
            $quote = 'Some say ' . $quote;
        }

        $this->merge(['quote' => $quote]);
    }
}
