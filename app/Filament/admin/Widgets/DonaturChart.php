<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Donatur;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class DonaturChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Donatur Bulanan';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('M');
        });

        $donaturPerBulan = collect(range(1, 12))->map(function ($month) {
            return Donatur::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->distinct('nama') // Ganti sesuai kolom nama donatur
                ->count('nama');   // Hitung donatur unik
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Donatur',
                    'data' => $donaturPerBulan->toArray(),
                    'backgroundColor' => '#f59e0b', // biru
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
                    'max' => 100, // ubah sesuai perkiraan maksimum donatur
                    'ticks' => [
                        'stepSize' => 20,
                        'color' => '#0F766E',
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
