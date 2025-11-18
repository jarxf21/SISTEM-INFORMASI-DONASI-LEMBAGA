<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Database\QueryException;
use Filament\Notifications\Notification;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
   ->withExceptions(function (Exceptions $exceptions) {
        // Tangkap error foreign key (relasi)
        $exceptions->render(function (QueryException $e, $request) {
            if ($e->getCode() === '23000') {
                // Kirim notifikasi Filament
                Notification::make()
                    ->title('Gagal Menghapus')
                    ->body('Data tidak bisa dihapus karena masih memiliki relasi.')
                    ->danger()
                    ->send();

                // Kembali ke halaman sebelumnya
                return back();
            }
        });
    })->create();