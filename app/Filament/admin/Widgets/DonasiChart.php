<?php
namespace App\Filament\Admin\Widgets;

use App\Models\Donasi;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;



class DonasiChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Donasi Bulanan';
    
    protected static ?int $sort = 1;

    protected function getData(): array
 {
    $months = collect(range(1, 12))->map(function ($month) {
        return \Carbon\Carbon::create()->month($month)->format('M');
    });

    $donasiPerBulan = collect(range(1, 12))->map(function ($month) {
        return round(Donasi::whereMonth('created_at', $month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah_donasi')); // total dalam juta
    });
    return [
        'datasets' => [
            [
                'label' => 'Total Donasi (Juta)',
                'data' => $donasiPerBulan->toArray(),
                'backgroundColor' => '#f59e0b',
            ],
        ],
        'labels' => $months->toArray(),
    ];
}

   

    protected function getType(): string
    {
        return 'bar';
    }
protected function getOptions(): array
{
    return [
        'scales' => [
            'y' => [
                'beginAtZero' => true,
                'min' => 0,
                'max' => 20000000,
                'ticks' => [
                    'stepSize' => 5000000,
                    'color' => '#0F766E',
                    // Tidak pakai 'callback'
                ],
                'grid' => [
                    'color' => 'rgba(255, 255, 255, 0.1)',
                ],
            ],
            'x' => [
                'ticks' => [
                    'color' => '#0F766E',
                ],
                'grid' => [
                    'display' => false,
                ],
            ],
        ],
    ];
}



}
