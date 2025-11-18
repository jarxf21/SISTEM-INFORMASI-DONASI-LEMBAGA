<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Campaign;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

class CampaignCardsWidget extends Widget
{
    use WithPagination;

    protected static string $view = 'filament.admin.widgets.campaign-cards-widget';
    public function getHeading(): string
    {
        return 'Campaign Terbaru';
    }
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    // Jumlah kampanye per halaman
    protected int $perPage = 3;

    public function getCampaigns()
    {
        return Campaign::with(['kategori', 'donasi'])
            ->latest('created_at')
            ->paginate($this->perPage);
    }

    public function formatCurrency($amount): string
    {
        if ($amount >= 1000000000) {
            return 'Rp ' . number_format($amount / 1000000000, 1) . 'M';
        } elseif ($amount >= 1000000) {
            return 'Rp ' . number_format($amount / 1000000, 1) . 'Jt';
        } elseif ($amount >= 1000) {
            return 'Rp ' . number_format($amount / 1000, 1) . 'K';
        } else {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }
    }

    public function getStatusColor($status): string
    {
        return match ($status) {
            'sedang berlangsung' => 'bg-green-100 text-green-800',
            'belum berlangsung' => 'bg-yellow-100 text-yellow-800',
            'terlaksana' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getCategoryColor($category): string
    {
        $colors = [
            'Amal' => 'bg-green-100 text-green-800',
            'Pendidikan' => 'bg-blue-100 text-blue-800',
            'Rumah Qur\'an' => 'bg-purple-100 text-purple-800',
            'Sosial' => 'bg-orange-100 text-orange-800',
            'Majelis' => 'bg-pink-100 text-pink-800',
            'Muallaf' => 'bg-indigo-100 text-indigo-800',
        ];

        return $colors[$category] ?? 'bg-gray-100 text-gray-800';
    }

    public function getDaysRemaining($endDate): string
    {
        $end = \Carbon\Carbon::parse($endDate);
        $now = \Carbon\Carbon::now();
        
        if ($end->isPast()) {
            return 'Selesai';
        }
        
        $diffInDays = $now->diffInDays($end);
        
        if ($diffInDays == 0) {
            return 'Hari terakhir';
        } elseif ($diffInDays == 1) {
            return '1 hari lagi';
        } else {
            return $diffInDays . ' hari lagi';
        }
    }

    public function render(): View
    {
        return view(static::$view, [
            'campaigns' => $this->getCampaigns(),
        ]);
    }
}