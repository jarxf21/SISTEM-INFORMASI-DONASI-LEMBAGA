<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barang';
    protected $primaryKey = 'id_kategori_barang';

    protected $fillable = [
        'nama_kategori_barang',
        'deskripsi',
    ];

    // Relasi ke DonasiBarang
    public function donasiBarang()
    {
        return $this->hasMany(DonasiBarang::class, 'id_kategori_barang', 'id_kategori_barang');
    }
}
