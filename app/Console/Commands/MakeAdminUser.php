<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;

class MakeAdminUser extends Command
{
    protected $signature = 'app:make-admin-user';
    protected $description = 'Create a new admin user';

    public function handle()
    {
        $username = $this->ask('Username');
        $nama = $this->ask('Nama Lengkap');
        $password = $this->secret('Password');

        Admin::create([
            'username' => $username,
            'nama' => $nama,
            'password' => $password,
        ]);

        $this->info('✅ Admin berhasil dibuat!');
    }
}
