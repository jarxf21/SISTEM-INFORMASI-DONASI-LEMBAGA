<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftarkan command agar dikenali artisan
     */
    protected $commands = [
        \App\Console\Commands\CheckCampaignResult::class,
        \App\Console\Commands\TestSchedule::class,
        \App\Console\Commands\PesanJadwal::class,

    ];

   protected function schedule(Schedule $schedule): void
{
    $schedule->command(\App\Console\Commands\CheckCampaignResult::class)
        ->everyMinute()
        ->timezone('Asia/Jakarta');

    $schedule->command(\App\Console\Commands\TestSchedule::class)
        ->everyMinute()
        ->timezone('Asia/Jakarta');

    $schedule->command(\App\Console\Commands\PesanJadwal::class)
        ->everyMinute()
        ->timezone('Asia/Jakarta');

    $schedule->command('inspire')->everyMinute();
}


    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
