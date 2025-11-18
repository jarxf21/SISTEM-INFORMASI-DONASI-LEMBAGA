<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Admin\Pages\Auth\EditProfile;
use Filament\Navigation\MenuItem;
use Illuminate\Support\Facades\Auth;

use App\Filament\Admin\Widgets\CampaignStatsWidget;
use App\Filament\Admin\Widgets\CampaignCardsWidget; // Widget card baru



use App\Filament\Admin\Pages\Auth\Login;
// use Filament\Pages\Auth\EditProfile;



class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->brandName('Sahabat Ummat') 
            ->brandLogo(null) // Hilangkan logo
            ->login()
            ->userMenuItems([
                        'greeting' => MenuItem::make()
                      ->label(function () {
                        $user = auth::user();
                        $hour = now()->format('H');
                        $greeting = match (true) {
                            $hour < 12 => 'Selamat Pagi',
                            $hour < 15 => 'Selamat Siang', 
                            $hour < 18 => 'Selamat Sore',
                            default => 'Selamat Malam'
                        };
                        return "🌟 {$greeting}, {$user?->nama}";
                    })
                    ->icon('heroicon-o-face-smile')
                    ->color('Amber')
                    
            
            ])
            ->profile(EditProfile::class)   
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
                
            ])
            ->discoverWidgets(
                in: app_path('Filament/Admin/Widgets'),
                for: 'App\\Custom\\FilamentWidgets'
            )
            ->widgets([ 
                \App\Filament\Admin\Widgets\DashboardStats::class,
                \App\Filament\Admin\Widgets\DonasiChart::class,
                \App\Filament\Admin\Widgets\DonaturChart::class,
                //  CampaignStatsWidget::class,      // Statistik di atas
                // CampaignCardsWidget::class,      // Cards dengan pagination (menggantikan CampaignListWidget)
               
             
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
