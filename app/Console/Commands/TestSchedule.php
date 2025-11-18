<?php

// app/Console/Commands/TestSchedule.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestSchedule extends Command
{
    protected $signature = 'test:schedule';
    protected $description = 'Tes apakah scheduler jalan';

    public function handle()
    {
        Log::info('TestSchedule DIJALANKAN pada: ' . now());
        $this->info('TestSchedule DIJALANKAN pada: ' . now());
        return Command::SUCCESS;
    }
}

