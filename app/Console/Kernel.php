<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run database backup daily at 1:00 AM
        $schedule->command('backup:run')->daily()->at('01:00');
        
        // Clean up old backups daily at 2:00 AM
        $schedule->command('backup:clean')->daily()->at('02:00');
        
        // Monitor backup health daily at 3:00 AM
        $schedule->command('backup:monitor')->daily()->at('03:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
