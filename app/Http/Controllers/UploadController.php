<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload; 

class UploadController extends Controller
{
    public function index()
    {
        $uploads = upload::get(); // Ambil semua data dari tabel uploads
        return view('coba.galery', compact('uploads')); // Kirim data ke Blade
    }
}
