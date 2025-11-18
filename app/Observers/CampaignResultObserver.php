<?php

namespace App\Observers;

use App\Models\Campaign;
use App\Jobs\SendCampaignResultNotificationJob;

class CampaignResultObserver
{
    public function saved(Campaign $campaign)
    {
        // hanya kirim jika status computed sudah "terlaksana" atau "Target Donasi Tercapai"
        // dan email belum pernah dikirim
        if (
            in_array($campaign->status_campaign, ['Target Donasi Tercapai', 'terlaksana']) 
            && !$campaign->result_email_sent
        ) {
            SendCampaignResultNotificationJob::dispatch($campaign);

            // flag sudah terkirim supaya tidak dobel
            $campaign->updateQuietly([
                'result_email_sent' => true,
                'result_email_sent_at' => now(),
            ]);
        }
    }
}
