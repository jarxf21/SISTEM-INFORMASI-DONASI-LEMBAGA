<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonasiBarang extends Model
{
    use HasFactory;

    protected $table = 'donasi_barang';
    protected $primaryKey = 'id_donasi_barang';

    protected $fillable = [
        'id_admin',
        'id_donatur',
        'id_campaign',
        'id_kategori_barang',
        'nama_barang',
        'jumlah',
        'satuan',
        'keterangan',
        'tanggal_donasi',
    ];

    // Relasi ke Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    // Relasi ke Donatur
    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur', 'id_donatur');
    }

    // Relasi ke Campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'id_campaign', 'id_campaign');
    }

    // Relasi ke KategoriBarang
    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategori_barang', 'id_kategori_barang');
    }
}
