<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSection;

class HeroSectionController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first(); // Ambil data hero pertama
        return view('homepage', compact('hero')); // Kirim ke view home.blade.php
    }
    
}
