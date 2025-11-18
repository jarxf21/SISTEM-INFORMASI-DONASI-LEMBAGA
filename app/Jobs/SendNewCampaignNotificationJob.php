<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Campaign;
use App\Notifications\NewCampaignNotification;
use Illuminate\Support\Facades\Notification;

class SendNewCampaignNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function handle()
    {
        $donateurs = \App\Models\Donatur::all();

        if ($donateurs->isNotEmpty()) {
            Notification::send($donateurs, new NewCampaignNotification($this->campaign));
        }
    }
}
