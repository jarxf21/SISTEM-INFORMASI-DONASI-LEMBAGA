<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Donasi</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
<script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'bounce-in': 'bounceIn 1s ease-out'
                    }
                }
            }
        }
    
   
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
    </style>
</head>   
@include('components.header')
   
<body class="bg-ivory">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-5xl font-bold text-black mb-4 tracking-tight">
                📊 Dashboard Donasi
            </h1>
            <p class="text-xl text-tombol mx-auto">
                Semua Donasi Anda kami Tampilkan Demi Menjaga Transparasi Untuk Kebaikan Bersama
            </p>
        </div>

        <!-- Statistics Section -->
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 mb-8 animate-slide-up">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    💰 Statistik Donasi
                </h2>
                
                <!-- Filter Controls -->
                 <div class="flex flex-col bg-back rounded-md p-4">
                <form method="GET" action="{{ route('donasi.index') }}">
                <select name="waktu" onchange="this.form.submit()" class="form-select">
                    <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                    <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>Tahun Ini</option>
                </select>
            </form>
            </div>



                    
                    {{-- <div class="flex flex-col">
                        <label class="text-sm font-semibold text-gray-600 mb-2">Program</label>
                        <select id="programFilter" class="px-4 py-2 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all bg-white">
                            <option value="all">Semua Program</option>
                            <option value="amal">🤲 Amal</option>
                            <option value="pendidikan">🎓 Pendidikan</option>
                            <option value="rumah-quran">📖 Rumah Qur'an</option>
                            <option value="majelis">🕌 Majelis</option>
                            <option value="muallaf">🌟 Mu'alaf</option>
                            <option value="sosial">❤️ Sosial</option>
                        </select>
                    </div> --}}
                    
                    {{-- <button onclick="updateStats()" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Filter
                    </button> --}}
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-tombol to-orange-400 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300 animate-bounce-in">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Total Donasi</p>
                            <p id="totalDonation" class="text-3xl font-bold">
                                Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-4xl">💰</div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-second to-navbar rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300 animate-bounce-in" style="animation-delay: 0.2s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Donatur</p>
                            <p id="totalDonors" class="text-3xl font-bold">{{ $totalDonatur }}</p>
                        </div>
                        <div class="text-4xl">👥</div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300 animate-bounce-in" style="animation-delay: 0.4s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Campaign Aktif</p>
                            <p id="activeCampaigns" class="text-3xl font-bold">{{ $totalCampaignAktif }}</p>
                        </div>
                        <div class="text-4xl">📈</div>
                    </div>
                </div>
            </div>

         <!-- Container horizontal -->
 @php
    use Illuminate\Support\Str;

    $logoMap = [
        'Sosial' => 'Sosial.png',
        'Pendidikan' => 'Pendidikan.png',
        'Rumah Qur\'an' => "Rumah Qur'an.png",
        'Mualaf' => 'Mualaf.png',
        'Amal' => 'Amal.png',
        'Majelis' => 'Majelis.png',
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
    @foreach ($donasiPerKategori as $item)
        @php
            $kategori = $item['kategori'];
            $logo = isset($logoMap[$kategori])
                ? asset('image/logo_kategori/' . $logoMap[$kategori])
                : asset('image/logo_kategori/default.png'); // fallback jika tidak ada
        @endphp

        <div class="glass-effect rounded-2xl p-6 text-center hover:shadow-medium transition-all duration-300 group cursor-pointer">
            <div class="w-12 h-12 mx-auto mb-3 group-hover:scale-110 transition-transform">
                <img src="{{ $logo }}" alt="{{ $kategori }}" class="w-full h-full object-contain rounded-full">
            </div>
            <p class="text-sm font-semibold text-navy mb-1">{{ $kategori }}</p>
            <p class="text-lg font-bold text-tombol">Rp {{ number_format($item['total'], 0, ',', '.') }}</p>
        </div>
    @endforeach
</div>





        
    <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 mb-8 animate-slide-up text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-orange-600 mb-4">DONASI SEKARANG</h2>
        <p class="text-gray-700 mb-6 text-base md:text-lg">
            Ulurkan tanganmu hari ini. Jadilah bagian dari perubahan yang lebih baik. Bantuan kecilmu sangat berarti bagi mereka yang membutuhkan.
        </p>
        <a href="#form-donasi" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full transition duration-300 shadow-lg hover:scale-105">
            Mulai Donasi
        </a>
    </div> 
 </div> 
@include("components.footer") 
     

<script>
            document.addEventListener("DOMContentLoaded", function () {
        const filterSelect = document.getElementById("campaignFilter");
        const cards = document.querySelectorAll(".campaign-card");

        filterSelect.addEventListener("change", function () {
            const selected = this.value;

            cards.forEach(card => {
                const kategori = card.getAttribute("data-kategori");
                if (selected === "all" || kategori === selected) {
                    card.classList.remove("hidden");
                } else {
                    card.classList.add("hidden");
                }
            });
        });
    });

        // Update statistics based on filters
        function updateStats() {
            
            
            // Add animation effect
            const cards = document.querySelectorAll('.animate-bounce-in');
            cards.forEach(card => {
                card.style.animation = 'none';
                setTimeout(() => {
                    card.style.animation = 'bounceIn 0.8s ease-out';
                }, 10);
            });
        }

        // Filter campaigns by program
        function filterCampaigns() {
            const filter = document.getElementById('campaignFilter').value;
            const campaigns = document.querySelectorAll('.campaign-card');
            
            campaigns.forEach(campaign => {
                const program = campaign.getAttribute('data-program');
                if (filter === 'all' || program === filter) {
                    campaign.style.display = 'block';
                    campaign.style.animation = 'fadeIn 0.6s ease-out';
                } else {
                    campaign.style.display = 'none';
                }
            });
        }

        // Add smooth scroll and hover effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect to cards
            const cards = document.querySelectorAll('.campaign-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05) translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) translateY(0)';
                });
            });

            // Auto-update animation on page load
            setTimeout(() => {
                const elements = document.querySelectorAll('.animate-slide-up, .animate-fade-in');
                elements.forEach((el, index) => {
                    el.style.animationDelay = `${index * 0.2}s`;
                });
            }, 100);
        });
        </script>
    </body>
</html>