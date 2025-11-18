<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Campaign;
use App\Models\HeroSection;
use Carbon\Carbon;
use App\Models\Kegiatan;
use App\Models\KategoriKegiatan;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Campaign aktif
        $totalCampaignAktif = Campaign::whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->count();

        // Donasi & statistik
        $donasi = Donasi::with('Kategori')->get();
        $totalDonasi = $donasi->sum('jumlah_donasi');
        $totalDonatur = $donasi->pluck('id_donatur')->unique()->count();
        $totalDonasiBulanan = Donasi::whereMonth('tanggal_donasi', Carbon::now()->month)->sum('jumlah_donasi');

        // Kegiatan terbaru
        $kegiatan = Kegiatan::with('kategori', 'admin')
            ->orderBy('tanggal_upload', 'desc')
            ->take(3)
            ->get();

        // Kategori list untuk filter
        $kategoriList = KategoriKegiatan::pluck('nama_kategori', 'id_kategori');

        // Hero section
        $hero = HeroSection::first();
        $kategori = KategoriKegiatan::select('id_kategori','nama_kategori','deskripsi_kategori','gambar_kategori','slug')
                ->get();

    // jika juga mau programs untuk JS, bisa bikin dari $kategori
    $programs = $kategori->map(function ($item) {
        return [
            'title'       => $item->nama_kategori,
            'description' => $item->deskripsi_kategori ?? '',
            'image'       => $item->gambar_kategori ? asset('storage/' . $item->gambar_kategori) : asset('images/default-kategori.jpg'),
            'thumbnail'   => $item->gambar_kategori ? asset('storage/' . $item->gambar_kategori) : asset('images/default-kategori.jpg'),
        ];
    })->toArray();

        return view('homepage', [
            'hero'                => $hero,
            'totalDonasi'         => $totalDonasi,
            'totalDonatur'        => $totalDonatur,
            'totalCampaignAktif'  => $totalCampaignAktif,
            'donasibulanan'       => $totalDonasiBulanan,
            'kegiatanterbaru'     => $kegiatan,
            'kategori'            => $kategori,
            'programs'            => $programs,
        ]);
    }
}
