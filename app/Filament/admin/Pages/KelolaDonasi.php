<?php
namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelolaDonasi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.admin.pages.kelola-donasi';
    protected static ?string $navigationGroup = 'Statistik';
    protected static ?string $title = 'Statistik Donasi';
    
    public $donasiPerKategori;
    public $kategoriKegiatan;
    public $totalDonasi;
    public $filterWaktu;

    public function mount(): void
    {
        $this->filterWaktu = request()->query('waktu', 'tahun');
        $start = null;
        $end = null;

        $useDateFilter = $this->filterWaktu !== 'semua';

        if ($useDateFilter) {
            $start = match ($this->filterWaktu) {
                'hari' => Carbon::now()->startOfDay(),
                'minggu' => Carbon::now()->startOfWeek(),
                'bulan' => Carbon::now()->startOfMonth(),
                'tahun' => Carbon::now()->startOfYear(),
                default => Carbon::now()->startOfYear(),
            };

            $end = Carbon::now()->endOfDay();
        }

        // ✅ Ambil semua kategori
        $this->kategoriKegiatan = DB::table('kategori_kegiatan')->get();

        // ✅ Ambil donasi per kategori
        $this->donasiPerKategori = DB::table('kategori_kegiatan')
            ->leftJoin('donasi', function ($join) use ($useDateFilter, $start, $end) {
                $join->on('kategori_kegiatan.id_kategori', '=', 'donasi.id_kategori');

                if ($useDateFilter && $start && $end) {
                    $join->whereBetween('donasi.tanggal_donasi', [
                        $start->toDateString(),
                        $end->toDateString(),
                    ]);
                }
            })
            ->select('kategori_kegiatan.nama_kategori', DB::raw('IFNULL(SUM(jumlah_donasi), 0) as total'))
            ->groupBy('kategori_kegiatan.nama_kategori')
            ->get();

        // ✅ Hitung total donasi (sesuai waktu jika dipilih)
        $this->totalDonasi = DB::table('donasi')
            ->when($useDateFilter && $start && $end, function ($query) use ($start, $end) {
                $query->whereBetween('tanggal_donasi', [
                    $start->toDateString(),
                    $end->toDateString(),
                ]);
            })
            ->sum('jumlah_donasi');
    }
}
