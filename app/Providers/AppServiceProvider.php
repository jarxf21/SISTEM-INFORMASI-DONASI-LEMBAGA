<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use App\Models\Kegiatan;
use App\Observers\KegiatanObserver;
use Illuminate\Support\Carbon;
use App\Models\SettingsContact;
use Illuminate\Support\Facades\View; 
use App\Models\Campaign;
use App\Observers\CampaignObserver;
use App\Models\Donasi;
use App\Observers\DonasiObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('local')) {
        URL::forceRootUrl(config('app.url'));
        Paginator::defaultView('components.modern-pagination');
         Kegiatan::observe(KegiatanObserver::class);
        Carbon::setLocale(config('app.locale'));
         $kontak = SettingsContact::first();
    View::share('kontak', $kontak);
    Donasi::observe(DonasiObserver::class);
     Campaign::observe(CampaignObserver::class);
    }
    }
}
