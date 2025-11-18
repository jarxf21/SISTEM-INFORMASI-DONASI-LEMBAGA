<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Campaign;
use App\Models\KategoriKegiatan;
use Carbon\Carbon;

class PublicDonasiController extends Controller
{
 public function index(Request $request)
    {
        // Ambil nilai filter dari dropdown
        $filter = $request->input('waktu', 'all');

        // Mulai query donasi dengan relasi ke kategori
        $query = Donasi::with('Kategori');

        // Filter waktu berdasarkan dropdown
        switch ($filter) {
            case 'today':
                $query->whereDate('tanggal_donasi', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('tanggal_donasi', [
                    Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
                ]);
                break;
            case 'month':
                $query->whereMonth('tanggal_donasi', Carbon::now()->month)
                      ->whereYear('tanggal_donasi', Carbon::now()->year);
                break;
            case 'year':
                $query->whereYear('tanggal_donasi', Carbon::now()->year);
                break;
            default:
                // Tidak ada filter tambahan
                break;
    }

        // Ambil data donasi hasil filter
        $donasi = $query->get();

        // Statistik dasar
        $totalDonasi = $donasi->sum('jumlah_donasi');
        $totalDonatur = $donasi->pluck('id_donatur')->unique()->count();
        $totalCampaignAktif = Campaign::whereDate('tanggal_mulai', '<=', Carbon::today())
        ->whereDate('tanggal_selesai', '>=', Carbon::today())
        ->count();



        // Total donasi bulanan
        $donasi_bulanan = Donasi::whereMonth('tanggal_donasi', Carbon::now()->month)->sum('jumlah_donasi');

        // Ambil semua kategori
        $semuaKategori = KategoriKegiatan::pluck('nama_kategori', 'id_kategori'); // [id => nama]

        // Kelompokkan donasi per kategori yang tersedia
        $donasiGroup = $donasi->groupBy('id_kategori')->map(function ($items) {
            return $items->sum('jumlah_donasi');
        });

        // Gabungkan semua kategori agar tetap muncul meskipun belum ada donasi
        $donasiPerKategori = [];
        foreach ($semuaKategori as $id => $nama) {
            $donasiPerKategori[] = [
                'kategori' => $nama,
                'total' => $donasiGroup[$id] ?? 0,
            ];
        }

        // Ambil data campaign
        // $campaigns = Campaign::with('Kategori')->where('status_campaign', 'aktif')->get();

        $today = Carbon::today();

        $campaignAktif = Campaign::with(['donasi', 'kategori'])
            ->where('tanggal_selesai', '>=', $today)
            ->paginate(3);

        $campaignBerakhir = Campaign::with(['donasi', 'kategori'])
            ->where('tanggal_selesai', '<', $today)
            ->paginate(3);

        // Kirim ke view
        return view('donasi.donasi', [
            'donasi' => $donasi,
            'totalDonasi' => $totalDonasi,
            'totalDonatur' => $totalDonatur,
            'totalCampaignAktif' => $totalCampaignAktif,
            'donasiPerKategori' => $donasiPerKategori,
            'filter' => $filter,
            // 'campaigns' => $campaigns,
            'campaignAktif' => $campaignAktif,
            'campaignBerakhir' => $campaignBerakhir,
            'donasibulanan' => $donasi_bulanan,
        ]);
    }
}
