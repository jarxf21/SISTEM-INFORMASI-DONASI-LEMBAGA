<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Campaign</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body>  
    <style>
         @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-slide-up {
            animation: slide-up 0.6s ease-out forwards;
        }
        .campaign-card {
            transition: all 0.3s ease;
        }
        .campaign-card.fade-out {
            opacity: 0;
            transform: scale(0.95);
        }
        .campaign-card.fade-in {
            opacity: 1;
            transform: scale(1);
        }
        .category-tab {
            transition: all 0.3s ease;
        }
        .category-tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
    @include("components.header") 
    <div class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 animate-slide-up mb-5" style="animation-delay: 0.3s">
                <!-- Header -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4">
                    <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                        📜 Riwayat Campaign Sahabat Ummat
                    </h2>
                
                    <select id="statusFilter" onchange="filterByStatus(this.value)"
                        class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
                        <option value="all">🌟 Semua Status</option>
                        <option value="tercapai">🎉 Target Tercapai</option>
                        <option value="tidak-tercapai">❌ Tidak Tercapai</option>
                    </select>
                
                    <a href="{{ route('campaign.index') }}" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                        ← Kembali ke Campaign Aktif
                    </a>
                    <!-- Filter Status dengan Dropdown -->


                </div>
    
                <!-- Category Tabs -->
                <div class="flex flex-wrap gap-3 mb-8 justify-center lg:justify-start">
                    <button onclick="filterByCategory('all')" class="category-tab active px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-purple-300">
                        🌟 Semua Program
                    </button>
                    @php
                    $kategoriIcons = [
                        'sosial' => 'Sosial.png',
                        'pendidikan' => 'Pendidikan.png',
                        'rumah-quran' => "Rumah Qur'an.png",
                        'mualaf' => 'Mualaf.png',
                        'amal' => 'Amal.png',
                        'majelis' => 'Majelis.png',
                    ];
                @endphp

                @foreach($campaignSelesai->groupBy('kategori.nama_kategori') as $kategoriNama => $campaignsByKategori)
                    @php
                        $kategoriSlug = strtolower(str_replace([' ', "'"], ['-', ''], $kategoriNama));
                        $icon = $kategoriIcons[$kategoriSlug] ?? '📋';
                    @endphp
                    <button onclick="filterByCategory('{{ $kategoriSlug }}')" class="category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-purple-300">
                        <img src="{{ asset('image/logo_kategori/' . ($kategoriIcons[$kategoriSlug] ?? 'default.png')) }}" alt="{{ $kategoriNama }}" class="inline w-5 h-5 mr-2 object-contain" />
                        {{ $kategoriNama }}
                    </button>
                @endforeach

                </div>
    
<!-- Campaign Terlaksana -->
<h2 class="text-2xl font-bold mb-4">✅ Campaign yang Telah Terlaksana</h2>

<div id="campaignGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @php $adaRiwayat = false; @endphp
    @foreach($campaignSelesai as $campaign)
        @if($campaign->status_riwayat)
            @php 
                $adaRiwayat = true; 
                $now = \Carbon\Carbon::now();
                $mulai = \Carbon\Carbon::parse($campaign->tanggal_mulai);
                $selesai = \Carbon\Carbon::parse($campaign->tanggal_selesai);
                $jumlahDonatur = $campaign->donasi->pluck('id_donatur')->unique()->count();
                $jumlahDonasi = $campaign->donasi->sum('jumlah_donasi') ?? 0;
                $persentase = $campaign->target_donasi > 0 ? ($jumlahDonasi / $campaign->target_donasi) * 100 : 0;

                $kategoriNama = $campaign->kategori->nama_kategori ?? 'Umum';
                $kategoriSlug = strtolower(str_replace([' ', "'"], ['-', ''], $kategoriNama));

                $kategoriColors = [
                    'amal' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'button' => 'bg-green-500 hover:bg-green-600', 'progress' => 'bg-green-500'],
                    'pendidikan' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'button' => 'bg-blue-500 hover:bg-blue-600', 'progress' => 'bg-blue-500'],
                    'rumah-quran' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800', 'button' => 'bg-emerald-500 hover:bg-emerald-600', 'progress' => 'bg-emerald-500'],
                    'majelis' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'button' => 'bg-purple-500 hover:bg-purple-600', 'progress' => 'bg-purple-500'],
                    'muallaf' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'button' => 'bg-yellow-500 hover:bg-yellow-600', 'progress' => 'bg-yellow-500'],
                    'sosial' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'button' => 'bg-red-500 hover:bg-red-600', 'progress' => 'bg-red-500']
                ];
                $colors = $kategoriColors[$kategoriSlug] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'button' => 'bg-gray-500 hover:bg-gray-600', 'progress' => 'bg-gray-500'];
            @endphp

<div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-200" 
     data-category="{{ $kategoriSlug }}" 
     data-status="{{ $campaign->status_singkat }}">

                <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100 relative">
                    @if($campaign->gambar_campaign)
                        <img src="{{ asset('storage/' . $campaign->gambar_campaign) }}" alt="{{ $campaign->judul_campaign }}" class="object-cover h-full w-full">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <span class="inline-block {{ $colors['bg'] }} {{ $colors['text'] }} text-xs px-3 py-1 rounded-full mb-3 font-semibold flex items-center gap-2">
                                {{ $kategoriNama }}
                            </span>
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <span class="inline-block {{ $colors['bg'] }} {{ $colors['text'] }} text-xs px-3 py-1 rounded-full mb-3 font-semibold">
                        {{ $kategoriNama }}
                    </span>

                    <h4 class="font-bold text-xl text-gray-800 mb-2">{{ $campaign->judul_campaign }}</h4>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($campaign->deskripsi, 100) }}</p>

                    <div class="flex justify-between text-sm text-gray-600 mb-4">
                        <span>👥 {{ $jumlahDonatur }} Donatur</span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="bg-gray-200 rounded-full h-2 mb-3">
                        <div class="{{ $colors['progress'] }} h-2 rounded-full transition-all duration-500" style="width: {{ min($persentase, 100) }}%"></div>
                    </div>

                    <div class="flex justify-between text-sm mb-3">
                        <span class="text-gray-600">Terkumpul: <strong class="text-green-600">Rp {{ number_format($jumlahDonasi, 0, ',', '.') }}</strong></span>
                        <span class="text-gray-600">{{ number_format($persentase, 1) }}%</span>
                    </div>

                    <div class="flex justify-between text-sm mb-4">
                        <span class="text-gray-500">Target: Rp {{ number_format($campaign->target_donasi, 0, ',', '.') }}</span>
                        @if($persentase >= 100)
                            <span class="text-green-600 font-semibold">🎉 Target Tercapai</span>
                        @else
                            <span class="text-orange-600 font-semibold">{{ number_format(100 - $persentase, 1) }}% dari target</span>
                        @endif
                    </div>

                    <!-- Tanggal Campaign -->
                    <div class="border-t pt-3 mt-3 text-xs text-gray-500">
                        <div class="flex justify-between mb-1">
                            <span>Mulai: {{ \Carbon\Carbon::parse($campaign->tanggal_mulai)->format('d M Y') }}</span>
                            <span>Selesai: {{ \Carbon\Carbon::parse($campaign->tanggal_selesai)->format('d M Y') }}</span>
                        </div>
                    </div>
                  <a href="{{ route('campaign.show', $campaign->slug) }}"
   class="inline-flex items-center gap-2 px-2 py-1 bg-gradient-to-r from-blue-500 to-blue-700 text-sm
          text-white font-semibold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    Lihat Detail
</a>


             <div class="mt-4">
@php
    $status = $campaign->status_riwayat;

    $colorClass = match ($status) {
        'Kegiatan Terlaksana' => 'bg-orange-500 hover:bg-orange-600',
        'Campaign Selesai' => 'bg-green-500 hover:bg-green-600',
        default => 'bg-gray-500 hover:bg-gray-600',
    };

    $message = match ($status) {
        'Kegiatan Terlaksana' => 'Terima kasih atas partisipasi Anda dalam campaign ini. Kegiatan sudah berhasil terlaksana Pada '
            . \Carbon\Carbon::parse($campaign->tanggal_kegiatan)->translatedFormat('l, d F Y'),
        'Campaign Selesai' => 'Campaign ini sudah selesai dan dijadwalkan pada tanggal ' 
            . \Carbon\Carbon::parse($campaign->tanggal_kegiatan)->translatedFormat('l, d F Y') 
            . '. Jika ada kelebihan donasi akan dialokasikan ke kegiatan sejenis.',
        default => 'Terima kasih sudah mendukung campaign ini.',
    };
@endphp


    <div class="text-center">
        <p class="{{ $colorClass }} text-white px-4 py-2 rounded-lg text-sm font-semibold w-full transition-all duration-300 transform hover:scale-105 shadow-lg">
            {{ $status }}
        </p>
        <p class="text-md text-gray-600 mt-2 italic">
            {{ $message }}
        </p>
    </div>
</div>


                </div>
            </div>
        @endif
    @endforeach

    @if(!$adaRiwayat)
        <div id="emptyState" class="col-span-full text-center py-16">
            <div class="text-6xl mb-4">📜</div>
            <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum Ada Campaign yang Selesai</h3>
            <p class="text-gray-500">Campaign yang sudah selesai akan ditampilkan di sini sebagai riwayat.</p>
        </div>
    @endif
</div>


<!-- Statistik Ringkasan -->
{{-- @if($adaTerlaksana)
<div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
    <h3 class="text-xl font-bold text-gray-800 mb-4">📊 Ringkasan Riwayat Campaign</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @php
            $totalCampaignTerlaksana = $campaignSelesai->filter(function($campaign) {
                $now = \Carbon\Carbon::now();
                $selesai = \Carbon\Carbon::parse($campaign->tanggal_selesai);
                $mulai = \Carbon\Carbon::parse($campaign->tanggal_mulai);
                $jumlahDonasi = $campaign->donasi->sum('jumlah_donasi') ?? 0;
                
                if ($jumlahDonasi >= $campaign->target_donasi) {
                    return false; // Target tercapai, bukan terlaksana
                } elseif ($now->lt($mulai)) {
                    return false; // belum berlangsung
                } elseif ($now->between($mulai, $selesai)) {
                    return false; // sedang berlangsung
                } else {
                    return true; // terlaksana
                }
            })->count();
            
            $totalDonasi = $campaignSelesai->sum(function($campaign) {
                $now = \Carbon\Carbon::now();
                $selesai = \Carbon\Carbon::parse($campaign->tanggal_selesai);
                $mulai = \Carbon\Carbon::parse($campaign->tanggal_mulai);
                $jumlahDonasi = $campaign->donasi->sum('jumlah_donasi') ?? 0;
                
                $statusCampaign = '';
                if ($jumlahDonasi >= $campaign->target_donasi) {
                    $statusCampaign = 'Target Donasi Tercapai';
                } elseif ($now->lt($mulai)) {
                    $statusCampaign = 'belum berlangsung';
                } elseif ($now->between($mulai, $selesai)) {
                    $statusCampaign = 'sedang berlangsung';
                } else {
                    $statusCampaign = 'terlaksana';
                }
                
                return $statusCampaign === 'terlaksana' ? $jumlahDonasi : 0;
            });
            
            $totalDonatur = $campaignSelesai->filter(function($campaign) {
                $now = \Carbon\Carbon::now();
                $selesai = \Carbon\Carbon::parse($campaign->tanggal_selesai);
                $mulai = \Carbon\Carbon::parse($campaign->tanggal_mulai);
                $jumlahDonasi = $campaign->donasi->sum('jumlah_donasi') ?? 0;
                
                $statusCampaign = '';
                if ($jumlahDonasi >= $campaign->target_donasi) {
                    $statusCampaign = 'Target Donasi Tercapai';
                } elseif ($now->lt($mulai)) {
                    $statusCampaign = 'belum berlangsung';
                } elseif ($now->between($mulai, $selesai)) {
                    $statusCampaign = 'sedang berlangsung';
                } else {
                    $statusCampaign = 'terlaksana';
                }
                
                return $statusCampaign === 'terlaksana';
            })->sum(function($campaign) {
                return $campaign->donasi->pluck('id_donatur')->unique()->count();
            });
            
            $campaignTercapai = $campaignSelesai->filter(function($campaign) {
                $jumlahDonasi = $campaign->donasi->sum('jumlah_donasi') ?? 0;
                return $jumlahDonasi >= $campaign->target_donasi;
            })->count();
        @endphp
        
        <div class="text-center p-4 bg-blue-50 rounded-xl">
            <div class="text-2xl font-bold text-blue-600">{{ $totalCampaignTerlaksana }}</div>
            <div class="text-sm text-gray-600">Campaign Terlaksana</div>
        </div>
        <div class="text-center p-4 bg-green-50 rounded-xl">
            <div class="text-2xl font-bold text-green-600">{{ number_format($totalDonasi, 0, ',', '.') }}</div>
            <div class="text-sm text-gray-600">Total Donasi Terkumpul</div>
        </div>
        <div class="text-center p-4 bg-purple-50 rounded-xl">
            <div class="text-2xl font-bold text-purple-600">{{ $totalDonatur }}</div>
            <div class="text-sm text-gray-600">Total Donatur</div>
        </div>
        <div class="text-center p-4 bg-yellow-50 rounded-xl">
            <div class="text-2xl font-bold text-yellow-600">{{ $campaignTercapai }}</div>
            <div class="text-sm text-gray-600">Target Tercapai</div>
        </div>
    </div>
</div>
@endif --}}

<!-- Pagination -->
<div class="border-t border-gray-200 my-8"></div>
<div class="mt-6">
    {{ $campaignSelesai->links('components.modern-pagination') }}
</div>

<script>
    function filterByCategory(category) {
        const cards = document.querySelectorAll('.campaign-card');
        const tabs = document.querySelectorAll('.category-tab');
        const emptyState = document.getElementById('emptyState');
        
        // Update active tab
        tabs.forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');
        
        let hasVisibleCards = false;

        // Animate cards out first
        cards.forEach(card => {
            card.classList.add('fade-out');
        });

        // After animation, show/hide cards and animate in
        setTimeout(() => {
            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                
                if (category === 'all' || category === cardCategory) {
                    card.style.display = 'block';
                    card.classList.remove('fade-out');
                    card.classList.add('fade-in');
                    hasVisibleCards = true;
                } else {
                    card.style.display = 'none';
                    card.classList.remove('fade-in');
                }
            });

            // Show/hide empty state
            if (hasVisibleCards || category === 'all') {
                if (emptyState) emptyState.classList.add('hidden');
            } else {
                // Tampilkan pesan khusus untuk kategori kosong
                if (emptyState) {
                    emptyState.classList.remove('hidden');
                    updateEmptyStateMessage(category);
                }
            }
        }, 150);
    }
    function filterByStatus(status) {
    const cards = document.querySelectorAll('.campaign-card');
    const emptyState = document.getElementById('emptyState');
    let hasVisibleCards = false;

    cards.forEach(card => {
        const cardStatus = card.getAttribute('data-status');

        if (status === 'all' || cardStatus === status) {
            card.style.display = 'block';
            card.classList.add('fade-in');
            hasVisibleCards = true;
        } else {
            card.style.display = 'none';
        }
    });

    if (emptyState) {
        if (hasVisibleCards) {
            emptyState.classList.add('hidden');
        } else {
            emptyState.classList.remove('hidden');
            emptyState.innerHTML = `
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">${status === 'tercapai' ? '🎉' : '❌'}</div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">
                        Tidak Ada Campaign ${status === 'tercapai' ? 'Target Tercapai' : 'Tidak Tercapai'}
                    </h3>
                </div>
            `;
        }
    }
}


    // Fungsi untuk update pesan empty state sesuai kategori
    function updateEmptyStateMessage(category) {
        const emptyState = document.getElementById('emptyState');
        if (!emptyState) return;
        
        // Mapping kategori sesuai dengan yang ada di PHP
        const categoryNames = {
            'amal': 'Amal',
            'pendidikan': 'Pendidikan', 
            'rumah-quran': 'Rumah Qur\'an',
            'majelis': 'Majelis',
            'muallaf': 'Mualaf',
            'sosial': 'Sosial'
        };

        const categoryIcons = {
            'amal': "<img src='/image/logo_kategori/Amal.png' class='inline w-12 h-12' />",
            'pendidikan': "<img src='/image/logo_kategori/Pendidikan.png' class='inline w-12 h-12' />",
            'rumah-quran': "<img src='/image/logo_kategori/Rumah%20Qur%27an.png' class='inline w-12 h-12' />",
            'majelis': "<img src='/image/logo_kategori/Majelis.png' class='inline w-12 h-12' />",
            'muallaf': "<img src='/image/logo_kategori/Mualaf.png' class='inline w-12 h-12' />",
            'sosial': "<img src='/image/logo_kategori/Sosial.png' class='inline w-12 h-12' />"
        };
        
        const categoryName = categoryNames[category] || category;
        const categoryIcon = categoryIcons[category] || '📋';
        
        emptyState.innerHTML = `
            <div class="text-center py-16">
                <div class="text-6xl mb-4">${categoryIcon}</div>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum Ada Campaign ${categoryName} yang Terlaksana</h3>
                <p class="text-gray-500">Campaign ${categoryName} yang sudah terlaksana akan ditampilkan di sini.</p>
            </div>
        `;
    }

    // Generate semua tab kategori (bahkan yang kosong)
    function generateAllCategoryTabs() {
        const tabContainer = document.querySelector('.flex.flex-wrap.gap-3.mb-8');
        if (!tabContainer) return;
        
        // Daftar semua kategori yang mungkin ada
        const allCategories = {
            'amal': { name: 'Amal', icon: '/image/logo_kategori/Amal.png' },
            'pendidikan': { name: 'Pendidikan', icon: '/image/logo_kategori/Pendidikan.png' },
            'rumah-quran': { name: 'Rumah Quran', icon: "/image/logo_kategori/Rumah Qur'an.png" },
            'majelis': { name: 'Majelis', icon: '/image/logo_kategori/Majelis.png' },
            'muallaf': { name: 'Muallaf', icon: '/image/logo_kategori/Mualaf.png' },
            'sosial': { name: 'Sosial', icon: '/image/logo_kategori/Sosial.png' }
        };
        
        // Cek kategori mana yang sudah ada di DOM
        const existingTabs = Array.from(tabContainer.querySelectorAll('.category-tab')).map(tab => {
            const onclick = tab.getAttribute('onclick');
            if (onclick) {
                const match = onclick.match(/filterByCategory\(["'](.+?)["']\)/);
                return match ? match[1] : null;
            }
            return null;
        }).filter(Boolean);
        
        // Tambahkan tab untuk kategori yang belum ada
        Object.keys(allCategories).forEach(categorySlug => {
            if (!existingTabs.includes(categorySlug) && categorySlug !== 'all') {
                const category = allCategories[categorySlug];
                const newTab = document.createElement('button');
                newTab.onclick = () => filterByCategory(categorySlug);
                newTab.className = 'category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-purple-300';
                newTab.innerHTML = `<img src="${category.icon}" alt="${category.name}" class="inline w-5 h-5 mr-2 object-contain" /> ${category.name}`;
                
                tabContainer.appendChild(newTab);
            }
        });
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.campaign-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('fade-in');
            }, index * 100);
        });
        
        // Generate semua tab kategori (termasuk yang kosong)
        generateAllCategoryTabs();
    });

    // Add button functionality with ripple effect
    document.querySelectorAll('button').forEach(button => {
        if (!button.onclick && !button.classList.contains('category-tab')) {
            button.addEventListener('click', function(e) {
                // Add ripple effect
                const ripple = document.createElement('span');
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.6);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        }
    });
    let selectedCategory = 'all';

function filterByCategory(category) {
    selectedCategory = category;
    document.querySelectorAll('.category-tab').forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');
    applyFilters();
}

function applyFilters() {
    const status = document.getElementById('statusFilter').value;
    const cards = document.querySelectorAll('.campaign-card');
    const emptyState = document.getElementById('emptyState');
    let hasVisibleCards = false;

    cards.forEach(card => {
        const cardCategory = card.getAttribute('data-category');
        const cardStatus = card.getAttribute('data-status');

        const matchCategory = (selectedCategory === 'all' || cardCategory === selectedCategory);
        const matchStatus = (status === 'all' || cardStatus === status);

        if (matchCategory && matchStatus) {
            card.style.display = 'block';
            card.classList.add('fade-in');
            hasVisibleCards = true;
        } else {
            card.style.display = 'none';
        }
    });

    if (emptyState) {
        if (hasVisibleCards) {
            emptyState.classList.add('hidden');
        } else {
            emptyState.classList.remove('hidden');
            emptyState.innerHTML = `
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">${status === 'tercapai' ? '🎉' : status === 'tidak-tercapai' ? '❌' : '📜'}</div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">
                        Tidak Ada Campaign ${status === 'all' ? '' : (status === 'tercapai' ? 'Target Tercapai' : 'Tidak Tercapai')}
                        ${selectedCategory !== 'all' ? ' di kategori ' + selectedCategory : ''}
                    </h3>
                </div>
            `;
        }
    }
}

</script>

</body>

</html>