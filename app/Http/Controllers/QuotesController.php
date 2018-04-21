<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuotesController extends Controller
{
    public function index(): View
    {
        $quotes = Quote::with('tweets', 'user')->latest()->paginate();

        return view('quotes.index', compact('quotes'));
    }

    public function store(QuoteRequest $request): RedirectResponse
    {
        Quote::create([
            'body' => $request->quote,
            'user_id' => auth()->check() ? auth()->user()->id : null,
        ]);

        return redirect()->route('quotes.index');
    }

    public function destroy(Quote $quote): RedirectResponse
    {
        $quote->delete();

        session()->flash('status', 'Quote has been deleted.');

        return redirect()->route('quotes.index');
    }

    public function edit(Quote $quote): View
    {
        return view('quotes.edit', compact('quote'));
    }

    public function update(QuoteRequest $request, Quote $quote): RedirectResponse
    {
        $quote->update(['body' => $request->quote]);

        session()->flash('status', 'Quote has been updated.');

        return redirect()->route('quotes.index');
    }
}
