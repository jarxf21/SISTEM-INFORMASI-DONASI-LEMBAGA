<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Campaign;

class NewCampaignNotification extends Notification implements ShouldQueue
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
        return (new MailMessage)
            ->subject('Campaign Baru: ' . $this->campaign->judul_campaign)
            ->greeting('Halo ' . $notifiable->nama . '!')
            ->line('Kami baru saja meluncurkan campaign baru berjudul:')
            ->line('**' . $this->campaign->judul_campaign . '**')
            ->line('Kami mengundang Anda untuk mendukung dan berpartisipasi.')
            ->action('Lihat Campaign', url('campaign/' . $this->campaign->id_campaign))
            ->salutation('Salam hangat, Lembaga Sahabat Ummat');
    }
}
