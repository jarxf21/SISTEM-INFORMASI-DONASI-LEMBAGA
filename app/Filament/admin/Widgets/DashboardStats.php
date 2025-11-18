<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Donatur;
use App\Models\Campaign;
use App\Models\Kegiatan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardStats extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        return [
            
            Card::make('Total Donatur', Donatur::count())
                ->description('Total Donatur Saat Ini')
                ->color('info'),
            Card::make('Total Kegiatan', Kegiatan::count())
                ->description('Kegiatan yang telah terlaksana'),
            Card::make(
                'Campaign Aktif',
                Campaign::all()->filter(fn ($item) => $item->status_campaign === 'sedang berlangsung')->count()
            )
            ->description('Campaign yang sedang berlangsung')
            ->color('success'),
            
        ];
    }
        protected function getColumns(): int
    {
        return 3;
    }

}
