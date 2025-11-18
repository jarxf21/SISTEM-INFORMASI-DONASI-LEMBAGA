<?php
//app/notifications/NewKegiatanNotifikasi.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Kegiatan;
use App\Models\Campaign;

class NewKegiatanNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $kegiatan;

    public function __construct(Kegiatan $kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    

    public function toMail($notifiable)
    {
        $judul_campaign = $this->kegiatan->campaign ? $this->kegiatan->campaign->judul_campaign : 'Campaign';
        
        return (new MailMessage)
            ->subject('Kegiatan Baru: ' . $this->kegiatan->judul)
            ->greeting('Halo ' . $notifiable->nama . '!')
            ->line('Ada kegiatan baru yang terkait dengan campaign Anda.')
            ->line('Terima kasih atas dukungan Anda untuk campaign "' . $judul_campaign . '".')
            ->line('Kami dengan senang hati mengumumkan kegiatan baru:')
            ->line('**' . $this->kegiatan->judul. '**')
           
            
            ->action('Lihat Detail Kegiatan', url('kegiatan/detail/' . $this->kegiatan->slug))
            ->line('Partisipasi Anda sangat berarti bagi kami!')
            ->salutation('Salam hangat, Lembaga Sahabat Ummat');
    }

    public function toArray($notifiable)
    {
        return [
            'kegiatan_id' => $this->kegiatan->id,
            'kegiatan_title' => $this->kegiatan->judul_kegiatan,
            'campaign_id' => $this->kegiatan->id_campaign,
            'donatur_id' => $notifiable->id,
        ];
    }
}