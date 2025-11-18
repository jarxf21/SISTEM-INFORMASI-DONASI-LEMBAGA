<?php

namespace App\Observers;

use App\Models\Donasi;
use App\Jobs\SendCampaignResultNotificationJob;

class DonasiObserver
{
    public function created(Donasi $donasi)
    {
        $campaign = $donasi->campaign;

        if ($campaign->terkumpul >= $campaign->target_donasi && !$campaign->result_email_sent) {
            SendCampaignResultNotificationJob::dispatch($campaign);

            $campaign->updateQuietly([
                'result_email_sent' => true,
                'result_email_sent_at' => now(),
            ]);
        }
    }
}
