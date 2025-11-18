<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class RiwayatCampaignController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua campaign yang sudah selesai
            $campaignSelesai = Campaign::with(['kategori', 'donasi'])
                ->where('tanggal_selesai', '<', now())
                ->orderBy('tanggal_selesai', 'desc')
                ->paginate(9);

            return view('campaign.riwayat', compact('campaignSelesai'));

        } catch (\Exception $e) {
            $campaignSelesai = collect()->paginate(9); 
            return view('campaign.riwayat', compact('campaignSelesai'));
        }
    }
}
