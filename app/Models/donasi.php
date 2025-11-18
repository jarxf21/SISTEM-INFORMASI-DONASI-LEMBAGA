<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Admin\Traits\PreventDeleteIfRelated;

class Donasi extends Model
{
    use HasFactory;
    use PreventDeleteIfRelated;
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';
    
    protected $fillable = [
        'id_admin',
        'id_donatur',
        'id_kategori',
        'id_campaign',
        'jumlah_donasi',
        'catatan',
        'bukti_transfer',
        'tanggal_donasi',
    ];

    protected $casts = [
        'tanggal_donasi' => 'date',
        'jumlah_donasi' => 'decimal:2',
    ];

    public function Admin()
    {
         return $this->belongsTo(\App\Models\Admin::class, 'id_admin');
    }

    public function Donatur()
    {
         return $this->belongsTo(\App\Models\Donatur::class, 'id_donatur');
    }

    public function Kategori()
    {
        return $this->belongsTo(\App\Models\KategoriKegiatan::class, 'id_kategori');
    }

    public function Campaign()
    {
        return $this->belongsTo(\App\Models\campaign::class, 'id_campaign');
    }
}