<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingsContact;

class SettingContactController extends Controller
{
    public function index()
    {
        $kontak = SettingsContact::first(); // Ambil data hero pertama
        return view('homepage','component.footer', compact('kontak')); // Kirim ke view home.blade.php
    }
    public function contactAdmin()
    {
        $kontak = SettingsContact::first();

        if ($kontak && $kontak->nomor_wa) {
            // Pastikan nomor hanya angka
            $nomor = preg_replace('/\D/', '', $kontak->nomor_wa);

            // Redirect ke WhatsApp
            return redirect()->away("https://wa.me/{$nomor}");
        }

        // Jika nomor tidak ditemukan
        abort(404, 'Nomor WhatsApp tidak ditemukan');
    }
}
