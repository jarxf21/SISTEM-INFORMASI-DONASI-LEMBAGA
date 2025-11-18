<?php
// app/Models/KategoriKegiatan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKegiatan extends Model
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Kegiatan';
    protected static ?string $title = 'Kategori Kegiatan';

    use HasFactory;
    
    protected $table = 'kategori_kegiatan';
    protected $primaryKey = 'id_kategori';
    
    protected $fillable = [
        'id_admin',
        'nama_kategori',
        'slug',
        'deskripsi_kategori',
        'gambar_kategori',
    ];


    // cara agar nama admin tampil di view 
    public function admin()
    {
    return $this->belongsTo(\App\Models\Admin::class, 'id_admin');
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'id_kategori', 'id_kategori');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'id_kategori', 'id_kategori');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}