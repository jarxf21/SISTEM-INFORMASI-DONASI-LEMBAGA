<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
class HeroSection extends Model
{
        
    protected $table = 'hero_sections'; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'judul',
        'deskripsi',
        'gambar',
    ];
}
