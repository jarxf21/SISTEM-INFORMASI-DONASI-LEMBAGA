<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Campaign;
use App\Models\KategoriKegiatan;
use Carbon\Carbon;

class PublicCampaignController extends Controller
{
    public function index(Request $request)
{
    $today = Carbon::now();

    // Query campaign sedang berlangsung
    $query = Campaign::with(['donasi', 'kategori'])
        ->whereDate('tanggal_mulai', '<=', Carbon::now())
        ->whereDate('tanggal_selesai', '>=', Carbon::now());
        

    // Filter kategori jika ada
    if ($request->has('kategori') && $request->kategori != 'all') {
        $query->whereHas('kategori', function($q) use ($request) {
            $q->where('nama_kategori', 'like', '%' . str_replace('-', ' ', $request->kategori) . '%');
        });
    }

    $campaignAktif = $query->paginate(9);

    $campaignTercapai = Campaign::where('target_donasi', '<=', function ($query) {
        $query->selectRaw('COALESCE(SUM(jumlah_donasi), 0)')
              ->from('donasi')
              ->whereColumn('donasi.id_campaign', 'campaign.id_campaign');
    })
    ->whereDate('tanggal_selesai', '>=', now())
    ->get();


    // Campaign berakhir (terlaksana)
    $campaignBerakhir = Campaign::with(['donasi', 'kategori'])
        ->whereDate('tanggal_selesai', '<', $today)
        ->paginate(3);


    // Campaign belum berlangsung
    $campaignBelum = Campaign::with(['donasi', 'kategori'])
        ->whereDate('tanggal_mulai', '>', $today)
        ->paginate(3);

    // Statistik campaign (semua)
    $campaigns = Campaign::withSum('donasi', 'jumlah_donasi')->get();

    // Data kategori (hanya campaign yang sedang berlangsung)
    $kategoris = KategoriKegiatan::withCount(['campaigns' => function($query) use ($today) {
        $query->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today);
    }])->having('campaigns_count', '>', 0)->get();

    return view('campaign.campaign', [
        'campaigns' => $campaigns,
        'campaignAktif' => $campaignAktif,
        'campaignBerakhir' => $campaignBerakhir,
        'campaignBelum' => $campaignBelum,
        'kategoris' => $kategoris,
        'selectedKategori' => $request->get('kategori', 'all')
    ]);
}

    /**
     * AJAX endpoint untuk filter campaign
     */
    
    public function filter(Request $request)
{
    $today = Carbon::today();
    $kategori = $request->get('kategori', 'all');

    $query = Campaign::with(['donasi', 'kategori'])
        ->whereDate('tanggal_mulai', '<=', $today)
        ->whereDate('tanggal_selesai', '>=', $today);

    if ($kategori != 'all') {
        $query->whereHas('kategori', function($q) use ($kategori) {
            $q->where('nama_kategori', 'like', '%' . str_replace('-', ' ', $kategori) . '%');
        });
    }

    $campaigns = $query->get();

    return response()->json([
        'success' => true,
        'campaigns' => $campaigns->map(function($campaign) {
            $hariTersisa = Carbon::parse($campaign->tanggal_selesai)->isFuture()
                ? Carbon::now()->diffInDays($campaign->tanggal_selesai)
                : 0;
            
            $jumlahDonatur = $campaign->donasi->pluck('id_donatur')->unique()->count();
            $jumlahDonasi = $campaign->donasi->sum('jumlah_donasi') ?? 0;
            $persentase = $campaign->target_donasi > 0 ? ($jumlahDonasi / $campaign->target_donasi) * 100 : 0;
            
            return [
                'id' => $campaign->id,
                'judul_campaign' => $campaign->judul_campaign,
                'deskripsi' => $campaign->deskripsi,
                'gambar_campaign' => $campaign->gambar_campaign,
                'target_donasi' => $campaign->target_donasi,
                'kategori' => [
                    'nama_kategori' => $campaign->kategori->nama_kategori ?? 'Umum'
                ],
                'hari_tersisa' => $hariTersisa,
                'jumlah_donatur' => $jumlahDonatur,
                'jumlah_donasi' => $jumlahDonasi,
                'persentase' => $persentase
            ];
        })
    ]);
}


    /**
     * Menampilkan detail campaign
     */
    public function show($id)
    {
        $campaign = Campaign::with(['donasi', 'kategori'])->findOrFail($id);
        
        $hariTersisa = Carbon::parse($campaign->tanggal_selesai)->isFuture()
            ? Carbon::now()->diffInDays($campaign->tanggal_selesai)
            : 0;
        
        $jumlahDonatur = $campaign->donasi->pluck('id_donatur')->unique()->count();
        $jumlahDonasi = $campaign->donasi->sum('jumlah_donasi') ?? 0;
        $persentase = $campaign->target_donasi > 0 ? ($jumlahDonasi / $campaign->target_donasi) * 100 : 0;

        // Campaign terkait dari kategori yang sama
        $campaignTerkait = Campaign::with(['donasi', 'kategori'])
            ->where('kategori_id', $campaign->kategori_id)
            ->where('id', '!=', $id)
            ->where('status_campaign', 'aktif')
            ->limit(3)
            ->get();

        return view('campaign.detail', compact(
            'campaign', 
            'hariTersisa', 
            'jumlahDonatur', 
            'jumlahDonasi', 
            'persentase',
            'campaignTerkait'
        ));
    }
}