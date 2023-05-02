<?php

namespace App\Console;

use App\Console\Commands\TestComand;
use App\Console\Commands\Web\AnularVentaTransferenciaComand;
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
        //TestComand::class
        // AnularVentaTransferenciaComand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         /*$schedule->command('test:cron')
                  ->everyMinute()
             ->withoutOverlapping();*/

        // $schedule->command('anularventa:transferencia')
        //     ->timezone('America/Lima')
        //     ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
