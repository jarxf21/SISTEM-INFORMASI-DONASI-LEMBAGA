<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Filament\Admin\Traits\PreventDeleteIfRelated;

class Campaign extends Model
{
    //try catch
    // use PreventDeleteIfRelated;
    // protected function getRelationsToCheck(): array
    // {
    // return ['donasi', 'kegiatan'];
    // }

    // protected function getRelationLabels(): array
    // {
    //     return [
    //         'donasi' => 'Donasi',
    //         'kegiatan' => 'Kegiatan',
    //     ];
    // 

    protected $appends = ['status_campaign'];
    use HasFactory;
    protected $table = 'campaign';
    protected $primaryKey = 'id_campaign';
    protected $fillable = [
        'id_admin',
        'id_kategori',
        'judul_campaign',
        'slug',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_kegiatan',
        'status_campaign',
        'tanggal_kegiatan',
        'gambar_campaign',
        'target_donasi',
         'result_email_sent',
        'result_email_sent_at',
         'result_email_sent_count',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
        'tanggal_mulai' => 'datetime',
        'tanggal_kegiatan' => 'date',
        'target_donasi' => 'decimal:2',
    ];

    public function admin()
    {
    return $this->belongsTo(\App\Models\Admin::class, 'id_admin');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(\App\Models\KategoriKegiatan::class, 'id_kategori');
    }
    public function donasi()
    {
        return $this->hasMany(\App\Models\Donasi::class, 'id_campaign');
     }
    public function kegiatan()
    {
        return $this->hasMany(\App\Models\Kegiatan::class, 'id_campaign');
    }
    public function getJumlahDonaturAttribute()
        {
        return $this->donasi->pluck('id_donatur')->unique()->count();
        }

            public function donasis()
        {
            return $this->hasMany(Donasi::class, 'id_campaign', 'id_campaign');
        }

        public function donasiBarangs()
        {
            return $this->hasMany(DonasiBarang::class, 'id_campaign', 'id_campaign');
        }


    public function getUniqueDonateurs()
    {
        return $this->donasi()
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
     // total terkumpul (computed)
    public function getTerkumpulAttribute()
    {
        // gunakan sum langsung di DB agar efisien
        return (float) $this->donasi()->sum('jumlah_donasi') ?? 0.0;
    }
     // persentase progress (0 - 100)
    public function getProgressAttribute()
    {
        if (empty($this->target_donasi) || $this->target_donasi == 0) {
            return 0.0;
        }
        $progress = ($this->terkumpul / (float) $this->target_donasi) * 100;
        return (float) min(100, round($progress, 2));
    }
// status umum campaign
public function getStatusCampaignAttribute()
{
    $now = \Carbon\Carbon::now();

    if ($now->lt($this->tanggal_mulai)) {
        return 'belum berlangsung';
    }

    if ($now->between($this->tanggal_mulai, $this->tanggal_selesai)) {
        return 'sedang berlangsung';
    }

    // kalau sudah lewat tanggal kegiatan → otomatis terlaksana
    if ($now->gt($this->tanggal_kegiatan)) {
        return 'kegiatan terlaksana';
    }

    // kalau sudah selesai tapi belum lewat tanggal_kegiatan → campaign selesai
    if ($this->terkumpul >= $this->target_donasi || $now->gt($this->tanggal_selesai)) {
        return 'campaign selesai';
    }

    return null;
}

// status khusus untuk riwayat
public function getStatusRiwayatAttribute()
{
    $now = now();

    // pastikan tanggal_kegiatan ada
    if ($this->tanggal_kegiatan && $now->gt($this->tanggal_kegiatan)) {
        return 'Kegiatan Terlaksana';
    }

    // pastikan tanggal_selesai ada
    if (
        $this->donasi->sum('jumlah_donasi') >= $this->target_donasi ||
        ($this->tanggal_selesai && $now->gt($this->tanggal_selesai))
    ) {
        return 'Campaign Selesai';
    }

    return null; // masih aktif (belum bisa masuk riwayat)
}


public function getStatusSingkatAttribute()
{
    if ($this->terkumpul >= $this->target_donasi) {
        return 'tercapai';
    }
    if (now()->gt($this->tanggal_selesai)) {
        return 'tidak-tercapai';
    }
    return 'berjalan'; // kalau masih aktif
}


    // protected static function booted()
    // {
    // static::saving(function ($campaign) {
    //     if ($campaign->tanggal_selesai && \Carbon\Carbon::parse($campaign->tanggal_selesai)->isPast()) {
    //         $campaign->status_campaign = 'selesai';
    //     }
    // });
    // }
//     public function getStatusCampaignAttribute($value)
// {
//     if ($value === 'aktif' && Carbon::parse($this->tanggal_selesai)->isPast()) {
//         return 'selesai';
//     }

//     return $value;
// }

// // Mutator - saat menyimpan ke database
// public function setGambarCampaignAttribute($value)
// {
//     // Hapus "campaigns/" jika ada
//     if ($value && strpos($value, 'campaigns/') === 0) {
//         $this->attributes['gambar_campaign'] = str_replace('campaigns/', '', $value);
//     } else {
//         $this->attributes['gambar_campaign'] = $value;
//     }
// }

// // Accessor - saat mengambil dari database untuk ditampilkan
//  public function getGambarCampaignUrlAttribute()
//     {
//         return $this->gambar_campaign ? asset('storage/campaigns/' . $this->gambar_campaign) : null;
//     }

protected static function boot()
{
    parent::boot();

    static::creating(function ($campaign) {
        if (empty($campaign->slug)) {
            $campaign->slug = Str::slug($campaign->judul_campaign) . '-' . uniqid();
        }
    });

    static::updating(function ($campaign) {
        if (empty($campaign->slug)) {
            $campaign->slug = Str::slug($campaign->judul_campaign) . '-' . uniqid();
        }
    });
}

}