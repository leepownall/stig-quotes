<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * @var array
     */
    protected $commands = [];

    protected function schedule(Schedule $schedule): void
    {
         $schedule
             ->command('quote:tweet')
             ->hourly();

        $schedule
            ->command('tweets:refresh')
            ->dailyAt('12:00');

        $schedule
            ->command('tweets:refresh')
            ->dailyAt('00:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
