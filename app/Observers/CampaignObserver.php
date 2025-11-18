<?php

namespace App\Observers;

use App\Models\Campaign;
use App\Jobs\SendNewCampaignNotificationJob;

class CampaignObserver
{
    // saat campaign baru dibuat
    public function created(Campaign $campaign)
    {
        // dispatch job kirim email campaign baru
        SendNewCampaignNotificationJob::dispatch($campaign);
    }
}
