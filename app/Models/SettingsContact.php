<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsContact extends Model
{
    protected $table = 'settings_contact'; // ✅ ini penting!
    protected $fillable = ['nomor_wa', 'nama_email'];
}
