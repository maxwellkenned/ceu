<?php

<<<<<<< HEAD
namespace ceu\Console;
=======
namespace App\Console;
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

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
<<<<<<< HEAD
        //
=======
        // Commands\Inspire::class,
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }
<<<<<<< HEAD

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
}
