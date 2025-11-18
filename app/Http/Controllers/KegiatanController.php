<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KategoriKegiatan;
use Illuminate\Support\Facades\Cache;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::with('kategori', 'admin')
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        $trendingKegiatan = Kegiatan::with('kategori')
        ->orderByDesc('views')
        ->limit(3)
        ->get();

        $kategori = KategoriKegiatan::all();

        return view('kegiatan.kegiatan', compact('kegiatan', 'kategori', 'trendingKegiatan'));
    }
    public function filterByKategori($kategoriSlug)
        {
            $kategori = \App\Models\KategoriKegiatan::where('slug', $kategoriSlug)->firstOrFail();

            $kegiatan = \App\Models\Kegiatan::with('admin', 'kategori')
                ->where('id_kategori', $kategori->id_kategori)
                ->orderBy('created_at', 'desc')
                ->paginate(1)
                ->appends(['kategori' => $kategoriSlug]); 
            $semuaKategori = \App\Models\KategoriKegiatan::all();
             $trendingKegiatan = Kegiatan::with('kategori')
            ->orderByDesc('views')
            ->limit(3)
            ->get();

            return view('kegiatan.filterKategori', [
                'kegiatan' => $kegiatan,
                'kategori' => $semuaKategori,
                'kategoriDipilih' => $kategori,
                'trendingKegiatan' => $trendingKegiatan,
            ]);
}
        public function detail($slug)
         {
        $kegiatan = Kegiatan::where('slug', $slug)->with('kategori')->firstOrFail();

        $this->incrementViews($kegiatan); // ← tambahkan ini

        $trendingKegiatan = Kegiatan::with('kategori')
        ->orderByDesc('views')
        ->limit(3)
        ->get();

          return view('kegiatan.detail', compact('kegiatan', 'trendingKegiatan'));

         }

       
    private function incrementViews(Kegiatan $kegiatan)
    {
    $cacheKey = 'kegiatan_viewed_' . $kegiatan->id_kegiatan . '_' . request()->ip();

    // Cek apakah IP ini sudah melihat kegiatan dalam 30 menit terakhir
    if (!Cache::has($cacheKey)) {
        $kegiatan->increment('views');

        // Simpan di cache selama 30 menit
        Cache::put($cacheKey, true, now()->addMinutes(30));
    }
    }
    public function trending()
    {
        $trendingKegiatan = Kegiatan::with('kategori')
                                   ->orderByDesc('views')
                                   ->limit(3)
                                   ->get();

        return view('kegiatan.trending', compact('trendingKegiatan'));
    }

    

}

