<?php

namespace App\Http\Controllers;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function show(Campaign $campaign)
    {
        return view('campaign.showCampaign', compact('campaign'));
    }

    public function history(Campaign $campaign)
    {
        $riwayat = $campaign->donations()->latest()->get(); // contoh relasi donations()
        return view('campaign.showCampaign', compact('campaign', 'riwayat'));
    }
}
