<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuotesController extends Controller
{
    public function index(): View
    {
        $quotes = Quote::latest()->paginate();

        return view('quotes.index', compact('quotes'));
    }

    public function store(StoreQuoteRequest $request): RedirectResponse
    {
        Quote::create([
            'body' => $request->quote,
            'user_id' => auth()->check() ? auth()->user()->id : null,
        ]);

        return redirect()->route('quotes.index');
    }
}
