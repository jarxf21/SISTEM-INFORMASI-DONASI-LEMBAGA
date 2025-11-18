<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Kegiatan;
use App\Notifications\NewKegiatanNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SendKegiatanNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kegiatan;

    public function __construct(Kegiatan $kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    public function handle()
    {
        try {
            // Ambil donatur yang terkait dengan kegiatan ini
            $donateurs = $this->kegiatan->getRelatedDonateurs();
            
            if ($donateurs->isEmpty()) {
                Log::info("No donateurs found for kegiatan: " . $this->kegiatan->id);
                return;
            }

            // Kirim notifikasi ke semua donatur terkait
            Notification::send($donateurs, new NewKegiatanNotification($this->kegiatan));
            
            // Update status email sent
            $this->kegiatan->update([
                'email_notification_sent' => true,
                'email_sent_at' => now(),
                'email_sent_count' => $donateurs->count()
            ]);

            Log::info("Email notifications sent for kegiatan: " . $this->kegiatan->id . " to " . $donateurs->count() . " donateurs");
            
        } catch (\Exception $e) {
            Log::error("Failed to send email notifications for kegiatan: " . $this->kegiatan->id . " - " . $e->getMessage());
            throw $e;
        }
    }
}