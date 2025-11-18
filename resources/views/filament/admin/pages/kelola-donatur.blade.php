 @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
<x-filament::page>
    <style>
        .dashboard-hero {
            background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            color: white;
        }
        
        .dashboard-hero h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: white;
        }
        
        .dashboard-hero p {
            color: #D1D5DB;
            font-size: 0.9rem;
        }
        
        .stat-card {
            border-radius: 12px;
            padding: 24px;
            border: 1px solid;
            transition: all 0.3s ease;
            margin-bottom: 24px;
        }
        
        .stat-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .stat-card.emerald {
            background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
            border-color: #D1D5DB;
        }
        
        .stat-card.blue {
            background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%);
            border-color: #D1D5DB;
        }
        
        .stat-card.amber {
            background: linear-gradient(135deg, #FAFAFA 0%, #F5F5F5 100%);
            border-color: #E5E7EB;
        }
        
        .stat-card.purple {
            background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
            border-color: #CBD5E0;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .stat-icon.emerald { background-color: #6B7280; }
        .stat-icon.blue { background-color: #9CA3AF; }
        .stat-icon.amber { background-color: #8B9DC3; }
        .stat-icon.purple { background-color: #64748B; }
        
        .stat-title {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .stat-title.emerald { color: #4B5563; }
        .stat-title.blue { color: #6B7280; }
        .stat-title.amber { color: #64748B; }
        .stat-title.purple { color: #374151; }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .stat-subtitle {
            font-size: 0.75rem;
            color: #6b7280;
            margin-bottom: 4px;
        }
        
        .content-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }
        
        .content-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        
        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            display: flex;
            align-items: center;
        }
        
        .card-badge {
            font-size: 0.875rem;
            color: #6b7280;
            background: #f3f4f6;
            padding: 4px 12px;
            border-radius: 9999px;
        }
        
        .donatur-item {
            display: flex;
            align-items: center;
            padding: 16px;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-bottom: 16px;
            transition: all 0.2s ease;
        }
        
        .donatur-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }
        
        .donatur-rank {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 16px;
            flex-shrink: 0;
        }
        
        .donatur-info {
            flex: 1;
        }
        
        .donatur-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }
        
        .donatur-label {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .donatur-amount {
            text-align: right;
            font-size: 1.25rem;
            font-weight: 700;
            color: #4B5563;
        }
        
        .kategori-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }
        
        .kategori-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }
        
        .kategori-dot {
            width: 12px;
            height: 12px;
            background: linear-gradient(135deg, #9CA3AF 0%, #6B7280 100%);
            border-radius: 50%;
            margin-right: 12px;
        }
        
        .kategori-name {
            font-weight: 500;
            color: #1f2937;
            flex: 1;
        }
        
        .kategori-count {
            font-size: 1.125rem;
            font-weight: 700;
            color: #4B5563;
            margin-right: 8px;
        }
        
        .kategori-label {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .empty-state {
            text-align: center;
            padding: 48px 0;
            color: #6b7280;
        }
        
        .empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            color: #9ca3af;
        }
        
        .footer-info {
            margin-top: 32px;
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
        
        @media (min-width: 768px) {
            .grid-4 {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .grid-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <!-- Hero Section -->
    <div class="dashboard-hero">
        <h1>Dashboard Donatur</h1>
        <p>Pantau aktivitas dan statistik donatur</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid-2">
        <div class="stat-card emerald">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 class="stat-title emerald">Total Donatur</h3>
                    <p class="stat-value">{{ $totalDonatur }}</p>
                </div>
                <div class="stat-icon emerald">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card blue">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 class="stat-title blue">Donatur Aktif</h3>
                    <p class="stat-subtitle">(30 Hari Terakhir)</p>
                    <p class="stat-value">{{ $donaturAktif }}</p>
                </div>
                <div class="stat-icon blue">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>

       

        
    </div>

    <!-- Main Content Grid -->
    <div class="grid-2">
        <!-- Top Donatur Card -->
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" style="color: #6B7280; margin-right: 8px;">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Top 5 Donatur
                </h3>
                <span class="card-badge">Berdasarkan Total Donasi</span>
            </div>
            
            <div>
                @forelse($topDonatur as $index => $item)
                    <div class="donatur-item">
                        <div class="donatur-rank">{{ $index + 1 }}</div>
                        <div class="donatur-info">
                            <p class="donatur-name">{{ $item->donatur->nama ?? 'Tidak diketahui' }}</p>
                            <p class="donatur-label">Total Donasi</p>
                        </div>
                        <div class="donatur-amount">
                            Rp{{ number_format($item->total, 0, ',', '.') }}
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p>Belum ada data donatur</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Kategori Card -->
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #6B7280; margin-right: 8px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Donatur per Kategori
                </h3>
                <span class="card-badge">Jumlah Donatur</span>
            </div>
            
            <div>
                @forelse($jumlahPerKategori as $item)
                    <div class="kategori-item">
                        <div style="display: flex; align-items: center; flex: 1;">
                            <div class="kategori-dot"></div>
                            <span class="kategori-name">{{ $item->nama_kategori ?? 'Tanpa Kategori' }}</span>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <span class="kategori-count">{{ $item->total }}</span>
                            <span class="kategori-label">donatur</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <p>Belum ada data kategori</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</x-filament::page>