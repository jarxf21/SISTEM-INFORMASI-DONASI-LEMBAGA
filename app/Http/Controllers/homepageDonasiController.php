<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Campaign;
use App\Models\HeroSection;
use Carbon\Carbon;
use App\Models\Kegiatan;
use App\Models\KategoriKegiatan;

class HomepageDonasiController extends Controller
{
    public function index()
    {
        // Campaign aktif
        $today = Carbon::today();
        $totalCampaignAktif = Campaign::whereDate('tanggal_mulai', '<=', $today)
        ->whereDate('tanggal_selesai', '>=', $today)
        ->count();


        $donasi = Donasi::with('Kategori')->get();
        $totalDonasi = $donasi->sum('jumlah_donasi');
        $totalDonatur = $donasi->pluck('id_donatur')->unique()->count();
        $totalDonasiBulanan = Donasi::whereMonth('tanggal_donasi', Carbon::now()->month)->sum('jumlah_donasi');
        $kegiatan = Kegiatan::with('kategori', 'admin')
            ->orderBy('tanggal_upload', 'desc')
            ->take(3)
            ->get();
        $kategoriList = KategoriKegiatan::pluck('nama_kategori', 'id_kategori');
       
        $hero = HeroSection::first(); // ambil data hero
        

        return view('homepage', [
            'hero' => $hero,
            'totalDonasi' => $totalDonasi,
            'totalDonatur' => $totalDonatur,
            'totalCampaignAktif' => $totalCampaignAktif,
            'donasibulanan' => $totalDonasiBulanan,
            'kegiatanterbaru'=>$kegiatan,
            'kategoriList' => $kategoriList,

        ]);
    }
}
