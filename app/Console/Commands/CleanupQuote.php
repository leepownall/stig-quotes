<?php

namespace App\Console\Commands;

use App\Pipes\AcceptableLength;
use App\Pipes\ContainsSwearing;
use App\Pipes\IsADuplicate;
use App\Pipes\TooLong;
use App\Pipes\TriesToAt;
use App\Quote;
use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;

class CleanupQuote extends Command
{
    /**
     * @var string
     */
    protected $signature = 'quote:cleanup {quote?}';

    /**
     * @var string
     */
    protected $description = 'Cleanup given quote or all quotes';

    public function handle(): void
    {
        $this
            ->quotes()
            ->each(function ($quote) {
                app(Pipeline::class)
                    ->send($quote)
                    ->through([
                        AcceptableLength::class,
                        ContainsSwearing::class,
                        TriesToAt::class,
                        IsADuplicate::class,
                        TooLong::class,
                    ])
                    ->then(function ($content) {});
            });
    }

    private function quotes()
    {
        if ($this->argument('quote') === null) {
            return Quote::all();
        }

        return collect(Quote::findOrFail($this->argument('quote')));
    }
}
