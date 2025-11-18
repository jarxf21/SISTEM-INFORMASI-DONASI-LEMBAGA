<?php

namespace App\Observers;

use App\Models\Kegiatan;

class KegiatanObserver
{
    public function created(Kegiatan $kegiatan)
    {
        
        $kegiatan->sendEmailNotification();
    }
}
