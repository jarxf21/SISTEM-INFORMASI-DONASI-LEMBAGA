<?php

namespace App\Filament\Admin\Pages;

use App\Models\Kegiatan;
use App\Models\KategoriKegiatan;
use Filament\Pages\Page;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KelolaKegiatan extends Page
{
    protected static string $view = 'filament.admin.pages.kelola-kegiatan';
    protected static ?string $navigationGroup = 'Statistik';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $title = 'Statistik Kegiatan';

    public $kategori = null;
    public $periode = 'bulan_ini';

    public function mount(Request $request)
    {
        $this->kategori = $request->input('kategori');
        $this->periode = $request->input('periode', 'bulan_ini');
    }

    public function getKegiatan()
    {
        $query = Kegiatan::with('kategori')->orderByDesc('views')->limit(3);

        if ($this->kategori) {
            $query->where('id_kategori', $this->kategori);
        }

        return $query->get();
    }

    public function getKategoriOptions()
    {
        return KategoriKegiatan::pluck('nama_kategori', 'id_kategori');
    }

    public function getTotalKegiatan()
    {
        return Kegiatan::count();
    }

    public function getTotalViews()
    {
        return Kegiatan::sum('views');
    }

    public function getKegiatanBulanIni()
    {
        return Kegiatan::whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year)
                      ->count();
    }

    public function getKegiatanTrending()
    {
        $periode = match($this->periode) {
            'hari_ini' => Carbon::today(),
            'minggu_ini' => Carbon::now()->startOfWeek(),
            'bulan_ini' => Carbon::now()->startOfMonth(),
            default => Carbon::now()->startOfMonth()
        };

        return Kegiatan::where('created_at', '>=', $periode)
                      ->orderByDesc('views')
                      ->limit(5)
                      ->get();
    }

    public function getKategoriStats()
    {
        try {
            return KategoriKegiatan::withCount('kegiatan')
                                  ->orderByDesc('kegiatan_count')
                                  ->limit(5)
                                  ->get();
        } catch (\Exception $e) {
            // Fallback jika relasi belum ada
            return KategoriKegiatan::select('id_kategori', 'nama_kategori')
                                  ->selectRaw('(SELECT COUNT(*) FROM kegiatan WHERE kegiatan.id_kategori = kategori_kegiatan.id_kategori) as kegiatan_count')
                                  ->orderByDesc('kegiatan_count')
                                  ->limit(5)
                                  ->get();
        }
    }

    public function getKegiatanTerbaru()
    {
        return Kegiatan::with('kategori')
                      ->latest()
                      ->limit(5)
                      ->get();
    }

    public function getViewsGrowth()
    {
        $bulanIni = Kegiatan::whereMonth('created_at', Carbon::now()->month)
                           ->whereYear('created_at', Carbon::now()->year)
                           ->sum('views');
        
        $bulanLalu = Kegiatan::whereMonth('created_at', Carbon::now()->subMonth()->month)
                            ->whereYear('created_at', Carbon::now()->subMonth()->year)
                            ->sum('views');

        if ($bulanLalu == 0) {
            return $bulanIni > 0 ? 100 : 0;
        }

        
        return round((($bulanIni - $bulanLalu) / $bulanLalu) * 100, 1);
    }
}