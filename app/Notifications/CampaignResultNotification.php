<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Campaign;

class CampaignResultNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->greeting('Halo ' . $notifiable->nama . '!')
            ->subject('Laporan Hasil Campaign: ' . $this->campaign->judul_campaign)
            ->line('Terima kasih atas partisipasi Anda dalam campaign "' . $this->campaign->judul_campaign . '".')
            ->line('Target Donasi: Rp ' . number_format($this->campaign->target_donasi, 0, ',', '.'))
            ->line('Terkumpul: Rp ' . number_format($this->campaign->terkumpul, 0, ',', '.'));

        if ($this->campaign->terkumpul >= $this->campaign->target_donasi) {
            // Skenario 1: target tercapai
            $mail->line('Alhamdulillah, target donasi telah tercapai. Dana akan segera digunakan sesuai tujuan campaign.')
                 ->line('Apabila ada kelebihan donasi, akan dialokasikan ke kegiatan sejenis.');
        } else {
            // Skenario 2: target tidak tercapai
            $mail->line('Campaign telah selesai, namun target donasi belum tercapai sepenuhnya.')
                 ->line('Dana yang sudah terkumpul tetap akan digunakan sebaik mungkin sesuai prioritas kebutuhan.')
                 ->line('Kekurangan dana akan dilanjutkan pada program berikutnya.');
        }

        return $mail->salutation('Salam hangat, Lembaga Sahabat Ummat');
    }
}
