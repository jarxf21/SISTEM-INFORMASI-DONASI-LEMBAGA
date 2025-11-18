<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Campaign;
use App\Notifications\CampaignResultNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SendCampaignResultNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function handle()
    {
        try {
            $donaturs = $this->campaign->getUniqueDonateurs();

            if ($donaturs->isEmpty()) {
                Log::info("No donaturs found for campaign: " . $this->campaign->id_campaign);
                return;
            }

            Notification::send($donaturs, new CampaignResultNotification($this->campaign));

            $this->campaign->updateQuietly([
                'result_email_sent' => true,
                'result_email_sent_at' => now(),
                'result_email_sent_count' => $donaturs->count()
            ]);

            Log::info("Campaign result email sent for campaign ID " . $this->campaign->id_campaign . " to " . $donaturs->count() . " donaturs");
        } catch (\Exception $e) {
            Log::error("Failed to send campaign result email for campaign ID " . $this->campaign->id_campaign . " - " . $e->getMessage());
            throw $e;
        }
    }
}
