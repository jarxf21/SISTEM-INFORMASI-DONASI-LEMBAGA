<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PesanJadwal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pesan:jadwal';

    /**
     * The console command description.
     *
     * @var string
     */
   protected $description = 'Menampilkan pesan sederhana untuk menguji jadwal Laravel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       

        // Tampilkan ke terminal
        $this->info('Pesan Jadwal berhasil dijalankan!');
    }
}
