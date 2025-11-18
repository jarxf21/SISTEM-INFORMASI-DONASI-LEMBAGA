<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Filament\Models\Contracts\HasName;
class Admin extends Authenticatable implements HasName
{
    use HasFactory, Notifiable;
    protected $signature = 'make:admin';
    protected $description = 'Create a new admin user';
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';


     public function getFilamentName(): string
    {
        return $this->nama ?? 'Admin';
    }
     public function getUserName(): string
    {
        return $this->nama ?? 'Admin';
    }
    protected $fillable = [
        'username',
        'password',
        'nama',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        // pastikan password tidak double hash jika kamu sudah pakai mutator
        // 'password' => 'hashed',
    ];

    /**
     * Mutator: Hash password sebelum disimpan
     */
    public function setPasswordAttribute($value)
    {
        // Hindari double hash jika sudah di-hash
        $this->attributes['password'] = strlen($value) === 60 && preg_match('/^\$2y\$/', $value)
            ? $value
            : Hash::make($value);
    }

    /**
     * Accessor: Ambil nama lengkap
     */
    public function getFullNameAttribute()
    {
        return $this->nama;
    }

    // ========================
    // Relationships
    // ========================

    public function kategoriKegiatans()
    {
        return $this->hasMany(KategoriKegiatan::class, 'id_admin', 'id_admin');
    }

    public function donaturs()
    {
        return $this->hasMany(Donatur::class, 'id_admin', 'id_admin');
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'id_admin', 'id_admin');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'id_admin', 'id_admin');
    }

    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'id_admin', 'id_admin');
    }

    // ========================
    // Custom Scope & Methods
    // ========================

    public function scopeActive($query)
    {
        return $query->whereNotNull('updated_at');
    }

    public function resetPassword()
    {
        $this->update([
            'password' => 'password123', // ini akan otomatis ter-hash lewat mutator
        ]);
    }

    public function isActive()
    {
        return !is_null($this->updated_at);
    }
}
