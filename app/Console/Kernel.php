<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\GetDataFromErpCommand::class,
        Commands\GetDataTripavisorCommand::class,
        Commands\SendEmailCommand::class,
        Commands\SendUntilEmails::class,
        Commands\GetTranslationDataForEmailsCommand::class,
        Commands\ImageCompression::class,
        Commands\ImageWebp::class,
        Commands\CreateUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cer:email:send')->everyMinute();
        $schedule->command('image:compression')->everyFiveMinutes();
        $schedule->command('cer:image:webp')->everyFiveMinutes();
        $schedule->command('cer:emailUntil:send')->hourly();
        $schedule->command('get:Data')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
