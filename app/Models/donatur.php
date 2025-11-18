<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Filament\Admin\Traits\PreventDeleteIfRelated;
use App\Models\Donasi;


class Donatur extends Model
{
    use HasFactory, Notifiable;
     use PreventDeleteIfRelated;
    protected $table = 'donatur';
    protected $primaryKey = 'id_donatur';
    protected function getRelationsToCheck(): array
    {
        return ['donasis']; // nama method relasi yang mau dicek
    }
    protected function getRelationLabels(): array
    {
    return [
        'donasis' => 'Donasi',
    ];
    }
    protected $fillable = [
        'id_admin',
        'nama',
        'alamat',
        'email',
        'no_whatsApp',
        
    ];
     protected $casts = [
        'receive_email_notifications' => 'boolean'
    ];

    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'id_admin');
    }

    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'id_donatur', 'id_donatur');
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    // Method untuk mendapatkan campaign yang pernah didonasi
    public function getCampaignsDonated()
    {
        return $this->donasi()
            ->with('campaign')
            ->get()
            ->pluck('campaign')
            ->unique('id');
    }
}