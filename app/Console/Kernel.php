<?php

namespace App\Console;

use App\Models\Article;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Existing schedule
        $schedule->command('messages:handle-expiry')->daily();

        // New schedule for updating article status
        $schedule->call(function () {
            $this->updateArticleStatus();
        })->everyMinute();
    }

    /**
     * Update the status of the articles.
     */
    protected function updateArticleStatus(): void
    {
        Article::where('scheduled_post', '<=', now())
            ->where('is_posted', false)
            ->update([
                'is_posted' => true,
                'published_on' => now(),
                'scheduled_post' => null
            ]);
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
