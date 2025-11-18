<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Campaign;
use App\Jobs\SendCampaignResultNotificationJob;

class CheckCampaignResult extends Command
{
    /**
     * Nama command untuk artisan
     */
    protected $signature = 'campaign:check-result';

    /**
     * Deskripsi command
     */
    protected $description = 'Cek semua campaign apakah sudah selesai / mencapai target dan kirim notifikasi result';

    /**
     * Jalankan command
     */
    public function handle()
    {
        $campaigns = Campaign::all();

        foreach ($campaigns as $campaign) {
            if (
                in_array($campaign->status_campaign, ['terlaksana', 'Target Donasi Tercapai']) &&
                !$campaign->result_email_sent
            ) {
                SendCampaignResultNotificationJob::dispatch($campaign);

                $campaign->updateQuietly([
                    'result_email_sent' => true,
                    'result_email_sent_at' => now(),
                ]);

                $this->info("Notifikasi campaign {$campaign->judul_campaign} terkirim.");
            }
        }

        return Command::SUCCESS;
    }
}
