@vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
<x-filament-panels::page>


    {{-- Judul --}}
    <div style="text-align: center; margin-bottom: 32px;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: white; display: flex; align-items: center; justify-content: center; gap: 12px; text-shadow: 0 4px 8px rgba(0,0,0,0.3); margin: 0;">
            <img src="https://img.icons8.com/color/48/000000/combo-chart.png" style="width: 40px; height: 40px; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));" />
            Statistik Donasi 
        </h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-top: 8px; margin-bottom: 0;">Dashboard Pengelolaan Donasi Terpadu</p>
    </div>

    {{-- Panel Utama --}}
    <div>
        
        {{-- Header Panel --}}
        <div style="display: flex; flex-direction: column; gap: 24px; margin-bottom: 32px; ">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="background: linear-gradient(135deg, #9CA3AF 0%, #6B7280 100%); padding: 12px; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                        <img src="https://img.icons8.com/emoji/48/money-bag-emoji.png" style="width: 28px; height: 28px;" />
                    </div>
                    <div>
                        <h2 style="font-size: 1.5rem; font-weight: 700; color: #1a202c; margin: 0;">Statistik Donasi</h2>
                        <p style="color: #718096; font-size: 0.9rem; margin: 0;">Pantau performa donasi secara real-time</p>
                    </div>
                </div>

                {{-- Filter Waktu --}}
                <div style="display: flex; gap: 16px;">
                    <form method="GET" style="display: flex; gap: 16px; align-items: center;">
                        <label style="font-weight: 600; color: #4a5568; font-size: 0.9rem;">Filter Periode:</label>
                        <select name="waktu" id="filterWaktu" 
                                style="background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%); 
                                       border: 2px solid #e2e8f0; 
                                       border-radius: 12px; 
                                       padding: 12px 16px; 
                                       font-weight: 600; 
                                       color: #2d3748; 
                                       min-width: 150px;
                                       transition: all 0.3s ease;
                                       box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
                                onchange="this.form.submit()"
                                onmouseover="this.style.borderColor='#6B7280'; this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'">
                            <option value="tahun" {{ request('waktu') === 'tahun' ? 'selected' : '' }}>📅 Tahun Ini</option>
                            <option value="hari" {{ request('waktu') === 'hari' ? 'selected' : '' }}>🌅 Hari Ini</option>
                            <option value="minggu" {{ request('waktu') === 'minggu' ? 'selected' : '' }}>📊 Minggu Ini</option>
                            <option value="bulan" {{ request('waktu') === 'bulan' ? 'selected' : '' }}>📈 Bulan Ini</option>
                            <option value="semua" {{ request('waktu') === 'semua' ? 'selected' : '' }}>🌍 Semua</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        {{-- Total Donasi Card --}}
        <div style="background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%); 
                    color: white; 
                    padding: 24px; 
                    border-radius: 20px; 
                    display: flex; 
                    align-items: center; 
                    justify-content: space-between; 
                    margin-bottom: 32px;
                    box-shadow: 0 12px 24px rgba(107, 114, 128, 0.4);
                    position: relative;
                    overflow: hidden;">
            
            {{-- Background Pattern --}}
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; opacity: 0.3;"></div>
            <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%; opacity: 0.2;"></div>
            
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                    <div style="background: rgba(255,255,255,0.2); padding: 8px; border-radius: 12px;">
                        💰
                    </div>
                    <div style="font-size: 1rem; font-weight: 500; opacity: 0.9;">Total Donasi Terkumpul</div>
                </div>
                <p style="font-size: 2.2rem; font-weight: 800; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                    Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}
                </p>
                <div style="font-size: 0.9rem; opacity: 0.8; margin-top: 4px;">
                    🎯 Mencapai target kebaikan bersama
                </div>
            </div>
            
            <div style="position: relative; z-index: 2;">
                <div style="background: rgba(255,255,255,0.2); padding: 20px; border-radius: 20px; text-align: center;">
                    <div style="font-size: 2rem;">📊</div>
                    <div style="font-size: 0.8rem; margin-top: 8px; opacity: 0.9;">Statistik Live</div>
                </div>
            </div>
        </div>

        {{-- Donasi per Program --}}
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="background: linear-gradient(135deg, #9CA3AF 0%, #6B7280 100%); padding: 12px; border-radius: 16px;">
                    <img src="https://img.icons8.com/color/48/combo-chart.png" style="width: 24px; height: 24px;" />
                </div>
                <div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; color: #1a202c; margin: 0;">Donasi per Program</h3>
                    <p style="color: #718096; font-size: 0.9rem; margin: 0;">Breakdown donasi berdasarkan kategori kegiatan</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                @foreach($kategoriKegiatan as $index => $kategori)
                    @php
                        $data = $donasiPerKategori->firstWhere('nama_kategori', $kategori->nama_kategori);
                        $colors = [
                            'linear-gradient(135deg, #6B7280 0%, #4B5563 100%)',
                            'linear-gradient(135deg, #9CA3AF 0%, #6B7280 100%)',
                            'linear-gradient(135deg, #8B9DC3 0%, #64748B 100%)',
                            'linear-gradient(135deg, #A7B5A3 0%, #8B9DC3 100%)',
                            'linear-gradient(135deg, #94A3B8 0%, #64748B 100%)',
                            'linear-gradient(135deg, #CBD5E0 0%, #A0AEC0 100%)',
                            'linear-gradient(135deg, #E2E8F0 0%, #CBD5E0 100%)',
                            'linear-gradient(135deg, #F7FAFC 0%, #EDF2F7 100%)'
                        ];
                        $gradientColor = $colors[$index % count($colors)];
                    @endphp
                    <div style="background: {{ $gradientColor }}; 
                                border-radius: 20px; 
                                padding: 24px; 
                                text-align: center; 
                                box-shadow: 0 8px 16px rgba(0,0,0,0.1); 
                                transition: all 0.3s ease;
                                position: relative;
                                overflow: hidden;
                                color: white;"
                         onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 16px 32px rgba(0,0,0,0.2)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'">
                        
                        {{-- Background Pattern --}}
                        <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%; opacity: 0.5;"></div>
                        
                        <div style="position: relative; z-index: 2;">
                            <div style="background: rgba(255,255,255,0.2); 
                                        width: 50px; 
                                        height: 50px; 
                                        border-radius: 50%; 
                                        display: flex; 
                                        align-items: center; 
                                        justify-content: center; 
                                        margin: 0 auto 16px; 
                                        font-size: 1.5rem;">
                            </div>
                            
                            <div style="font-size: 0.95rem; font-weight: 600; margin-bottom: 12px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                {{ $kategori->nama_kategori }}
                            </div>
                            
                            <div style="font-size: 1.4rem; font-weight: 800; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                                @if($data)
                                    Rp {{ number_format($data->total, 0, ',', '.') }}
                                @else
                                    <span style="font-size: 0.9rem; opacity: 0.8;">Belum ada donasi</span>
                                @endif
                            </div>
                            
                            @if($data)
                                <div style="font-size: 0.8rem; opacity: 0.9; margin-top: 8px;">
                                </div>
                            @else
                                <div style="font-size: 0.8rem; opacity: 0.8; margin-top: 8px;">
                                    🚀 Menanti kontribusi
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

  


<script>
    document.getElementById('filterWaktu').addEventListener('change', function () {
        const waktu = this.value;
        const url = new URL(window.location.href);
        url.searchParams.set('waktu', waktu);
        window.location.href = url.toString(); // refresh page with waktu param
    });
</script>
</x-filament-panels::page>