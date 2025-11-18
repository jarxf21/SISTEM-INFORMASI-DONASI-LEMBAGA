<?php

namespace App\Filament\Admin\Pages;

use App\Models\Donatur;
use App\Models\Donasi;
use App\Models\KategoriKegiatan;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;


class KelolaDonatur extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.admin.pages.kelola-donatur';
    protected static ?string $title = 'Statistik Donatur';
    protected static ?string $navigationGroup = 'Statistik';

    public function getViewData(): array
    {
        $totalDonatur = Donatur::count();

        $donaturAktif = Donasi::where('tanggal_donasi', '>=', now()->subDays(30))
            ->distinct('id_donatur')
            ->count('id_donatur');

        $topDonatur = Donasi::select('id_donatur', DB::raw('SUM(jumlah_donasi) as total'))
            ->groupBy('id_donatur')
            ->orderByDesc('total')
            ->with('donatur')
            ->take(5)
            ->get();

        $jumlahPerKategori = DB::table('kategori_kegiatan')
    ->select(
        'kategori_kegiatan.id_kategori',
        'kategori_kegiatan.nama_kategori',
        DB::raw('COUNT(DISTINCT donasi.id_donatur) as total')
    )
    ->leftJoin('donasi', 'kategori_kegiatan.id_kategori', '=', 'donasi.id_kategori')
    ->groupBy('kategori_kegiatan.id_kategori', 'kategori_kegiatan.nama_kategori')
    ->get();

        return [
            'totalDonatur' => $totalDonatur,
            'donaturAktif' => $donaturAktif,
            'topDonatur' => $topDonatur,
            'jumlahPerKategori' => $jumlahPerKategori,
        ];
    }
}
