<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\SendKegiatanNotificationJob;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    
    protected $fillable = [
        'id_admin',
        'id_kategori',
        'id_campaign',
        'judul',
        'dokumentasi_kegiatan',
        'deskripsi_lengkap',
        'tanggal_upload',
        'slug',
        'status',
        'email_notification_sent',
        
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
        'email_notification_sent' => 'boolean',
        
    ];

    // Event observer untuk mengirim notifikasi otomatis
    protected static function booted()
    {
        // Ketika kegiatan baru dibuat
        static::created(function ($kegiatan) {
            if ($kegiatan->status === 'published') {
                dispatch(new SendKegiatanNotificationJob($kegiatan));
            }
        });

        // Ketika kegiatan diupdate dan status berubah menjadi active/published
        static::updated(function ($kegiatan) {
            if ($kegiatan->wasChanged('status') && 
                ($kegiatan->status === 'published') &&
                !$kegiatan->email_notification_sent) {
                dispatch(new SendKegiatanNotificationJob($kegiatan));
            }
        });
    }

    public function campaign()
    {
    return $this->belongsTo(\App\Models\Campaign::class, 'id_campaign');
    }

    public function admin()
    {
       return $this->belongsTo(\App\Models\Admin::class, 'id_admin');
    }

    public function kategori()
    {
        return $this->belongsTo(\App\Models\KategoriKegiatan::class, 'id_kategori');
    }

   

    // public function notifikasis()
    // {
    //     return $this->hasMany(Notifikasi::class, 'id_program', 'id_kegiatan');
    // }

    public function getRelatedDonateurs()
    {
        // Ambil donatur berdasarkan campaign yang terkait dengan kegiatan ini
        if ($this->campaign) {
            return $this->campaign->donasi()
                ->with('donatur')
                ->get()
                ->pluck('donatur')
                ->unique('id_donatur')
                ->filter(function ($donatur) {
                    return $donatur && 
                           $donatur->email && 
                           ($donatur->receive_email_notifications ?? true);
                });
        }
        
        return collect();
    }
    public function sendEmailNotification()
    {
        dispatch(new SendKegiatanNotificationJob($this));
    }
    
}