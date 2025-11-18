<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign - Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 animate-slide-up mb-5" style="animation-delay: 0.3s">
            <!-- Header -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    🎯 Campaign 
                </h2>
            </div>

            <!-- Category Tabs -->
            <div class="flex flex-wrap gap-3 mb-8 justify-center lg:justify-start">
                <button onclick="filterByCategory('all')" class="category-tab active px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-purple-300">
                    🌟 Semua Program
                </button>
                <button onclick="filterByCategory('amal')" class="category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-green-300">
                    🤲 Amal
                </button>
                <button onclick="filterByCategory('pendidikan')" class="category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-blue-300">
                    🎓 Pendidikan
                </button>
                <button onclick="filterByCategory('rumah-quran')" class="category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-emerald-300">
                    📖 Rumah Qur'an
                </button>
                <button onclick="filterByCategory('majelis')" class="category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-purple-300">
                    🕌 Majelis
                </button>
                <button onclick="filterByCategory('muallaf')" class="category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-yellow-300">
                    🌟 Mu'alaf
                </button>
                <button onclick="filterByCategory('sosial')" class="category-tab px-6 py-3 rounded-2xl font-semibold text-gray-700 bg-white border-2 border-gray-200 hover:border-red-300">
                    ❤️ Sosial
                </button>
            </div>

            <!-- Campaign Grid -->
            <div id="campaignGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Amal Campaigns -->
                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="amal">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/22c55e/ffffff?text=Amal+Program" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">🤲 Amal</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Bantuan untuk Anak Yatim</h4>
                        <p class="text-gray-600 text-sm mb-3">Membantu anak-anak yatim untuk mendapatkan kehidupan yang lebih baik dan pendidikan yang layak.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 150 Donatur</span>
                            <span>⏰ 25 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 65.000.000</span>
                            <span class="text-gray-600">Target: Rp 100.000.000</span>
                        </div>
                        <button class="w-full bg-green-500 text-white py-2 rounded-xl hover:bg-green-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="amal">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/16a34a/ffffff?text=Bantuan+Bencana" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">🤲 Amal</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Bantuan Korban Bencana</h4>
                        <p class="text-gray-600 text-sm mb-3">Memberikan bantuan darurat untuk korban bencana alam yang membutuhkan.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 89 Donatur</span>
                            <span>⏰ 12 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 22.500.000</span>
                            <span class="text-gray-600">Target: Rp 50.000.000</span>
                        </div>
                        <button class="w-full bg-green-500 text-white py-2 rounded-xl hover:bg-green-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <!-- Pendidikan Campaigns -->
                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="pendidikan">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/3b82f6/ffffff?text=Beasiswa+Pendidikan" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">🎓 Pendidikan</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Beasiswa untuk Siswa Berprestasi</h4>
                        <p class="text-gray-600 text-sm mb-3">Program beasiswa untuk siswa berprestasi dari keluarga kurang mampu.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 203 Donatur</span>
                            <span>⏰ 30 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 78.000.000</span>
                            <span class="text-gray-600">Target: Rp 100.000.000</span>
                        </div>
                        <button class="w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="pendidikan">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/2563eb/ffffff?text=Perpustakaan+Desa" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">🎓 Pendidikan</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Pembangunan Perpustakaan Desa</h4>
                        <p class="text-gray-600 text-sm mb-3">Membangun perpustakaan untuk meningkatkan literasi masyarakat desa.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 67 Donatur</span>
                            <span>⏰ 45 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 34%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 17.000.000</span>
                            <span class="text-gray-600">Target: Rp 50.000.000</span>
                        </div>
                        <button class="w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <!-- Rumah Qur'an Campaigns -->
                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="rumah-quran">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/10b981/ffffff?text=Rumah+Quran" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">📖 Rumah Qur'an</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Pembangunan Rumah Qur'an</h4>
                        <p class="text-gray-600 text-sm mb-3">Membangun tempat pembelajaran Al-Qur'an untuk masyarakat.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 124 Donatur</span>
                            <span>⏰ 20 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: 56%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 56.000.000</span>
                            <span class="text-gray-600">Target: Rp 100.000.000</span>
                        </div>
                        <button class="w-full bg-emerald-500 text-white py-2 rounded-xl hover:bg-emerald-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="rumah-quran">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/059669/ffffff?text=Tahfidz+Center" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">📖 Rumah Qur'an</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Tahfidz Center</h4>
                        <p class="text-gray-600 text-sm mb-3">Pusat tahfidz Al-Qur'an untuk generasi muda.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 93 Donatur</span>
                            <span>⏰ 40 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: 31%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 15.500.000</span>
                            <span class="text-gray-600">Target: Rp 50.000.000</span>
                        </div>
                        <button class="w-full bg-emerald-500 text-white py-2 rounded-xl hover:bg-emerald-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <!-- Majelis Campaigns -->
                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="majelis">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/8b5cf6/ffffff?text=Majelis+Taklim" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">🕌 Majelis</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Renovasi Majelis Taklim</h4>
                        <p class="text-gray-600 text-sm mb-3">Renovasi tempat kajian dan majelis taklim untuk kenyamanan jamaah.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 98 Donatur</span>
                            <span>⏰ 35 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 42%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 21.000.000</span>
                            <span class="text-gray-600">Target: Rp 50.000.000</span>
                        </div>
                        <button class="w-full bg-purple-500 text-white py-2 rounded-xl hover:bg-purple-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <!-- Mu'alaf Campaigns -->
                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="muallaf">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/f59e0b/ffffff?text=Pembinaan+Muallaf" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">🌟 Mu'alaf</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Pembinaan Saudara Mu'alaf</h4>
                        <p class="text-gray-600 text-sm mb-3">Program pembinaan dan pendampingan untuk saudara mu'alaf.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 76 Donatur</span>
                            <span>⏰ 28 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 38%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 19.000.000</span>
                            <span class="text-gray-600">Target: Rp 50.000.000</span>
                        </div>
                        <button class="w-full bg-yellow-500 text-white py-2 rounded-xl hover:bg-yellow-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <!-- Sosial Campaigns -->
                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="sosial">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/ef4444/ffffff?text=Bantuan+Kesehatan" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">❤️ Sosial</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Bantuan Kesehatan Masyarakat</h4>
                        <p class="text-gray-600 text-sm mb-3">Program bantuan kesehatan untuk masyarakat kurang mampu.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 187 Donatur</span>
                            <span>⏰ 18 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 72.000.000</span>
                            <span class="text-gray-600">Target: Rp 100.000.000</span>
                        </div>
                        <button class="w-full bg-red-500 text-white py-2 rounded-xl hover:bg-red-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>

                <div class="campaign-card fade-in bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100" data-category="sosial">
                    <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/dc2626/ffffff?text=Air+Bersih" alt="Gambar Campaign" class="object-cover h-full w-full">
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full mb-3 font-semibold">❤️ Sosial</span>
                        <h4 class="font-bold text-xl text-gray-800 mb-2">Penyediaan Air Bersih</h4>
                        <p class="text-gray-600 text-sm mb-3">Program penyediaan akses air bersih untuk daerah terpencil.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>👥 134 Donatur</span>
                            <span>⏰ 22 hari lagi</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 58%"></div>
                        </div>
                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Terkumpul: Rp 29.000.000</span>
                            <span class="text-gray-600">Target: Rp 50.000.000</span>
                        </div>
                        <button class="w-full bg-red-500 text-white py-2 rounded-xl hover:bg-red-600 transition font-semibold">Donasi Sekarang</button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Tidak ada campaign ditemukan</h3>
                <p class="text-gray-500">Silakan pilih kategori lain atau kembali ke semua program</p>
            </div>

            <!-- Pagination -->
            <div class="border-t border-gray-200 my-8"></div>
            <div class="flex justify-center items-center gap-2">
                <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">« Sebelumnya</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg">1</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">2</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">3</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">Selanjutnya »</button>
            </div>
        </div>
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
                if (hasVisibleCards) {
                    emptyState.classList.add('hidden');
                } else {
                    emptyState.classList.remove('hidden');
                }
            }, 150);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.campaign-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('fade-in');
                }, index * 100);
            });
        });

        // Add donation button functionality
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Donasi Sekarang')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
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
                    
                    // Simulate redirect to donation page
                    setTimeout(() => {
                        alert('Mengarahkan ke halaman donasi...');
                    }, 300);
                });
            }
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <title>Campaign</title>
</head>
<body>
    @include('components.header')
      <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 animate-slide-up mb-5" style="animation-delay: 0.3s">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    🎯 Campaign 
                </h2>
                
                <!-- Campaign Filter -->
                <div class="flex gap-4 items-end">
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold text-gray-600 mb-2">Filter Program</label>
                        <select id="campaignFilter" class="px-4 py-2 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all bg-white">
                            <option value="all">Semua Program</option>
                            <option value="amal">🤲 Amal</option>
                            <option value="pendidikan">🎓 Pendidikan</option>
                            <option value="rumah-quran">📖 Rumah Qur'an</option>
                            <option value="majelis">🕌 Majelis</option>
                            <option value="muallaf">🌟 Mu'alaf</option>
                            <option value="sosial">❤️ Sosial</option>
                        </select>
                    </div>
                    
                    <button onclick="filterCampaigns()" class="px-6 py-2 bg-gradient-to-r from-green-600 to-blue-600 text-white font-semibold rounded-xl hover:from-green-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Filter
                    </button>
                </div>
            </div>

            {{-- campaign --}}
            {{-- Campaign Aktif --}}
            <h2 class="text-2xl font-bold text-gray-800 mb-4">🎯 Campaign Aktif</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($campaignAktif as $campaign)
                    @php
                        $hariTersisa = \Carbon\Carbon::parse($campaign->tanggal_selesai)->isFuture()
                            ? \Carbon\Carbon::now()->diffInDays($campaign->tanggal_selesai)
                            : 0;

                         $jumlahDonatur = $campaign->donasi->pluck('id_donatur')->unique()->count();
                    @endphp
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105 overflow-hidden border border-gray-100">
                         <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                            <img src="{{ asset('storage/' . $campaign->gambar_campaign) }}" alt="Gambar Campaign" class="object-contain h-full w-full">
                        </div>

                        <div class="p-6">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-2">{{ $campaign->kategori->nama_kategori ?? 'Kategori' }}</span>
                            <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <h3 class="font-bold text-xl text-gray-800">{{ $campaign->judul_campaign }}</h3>
                             @php
                            $jumlahDonasi = $campaign->donasi->pluck('jumlah_donasi')->sum() ?? 0;
                        @endphp

                            </div>
                            <p class="text-gray-600 text-sm mb-3">{{ $campaign->deskripsi }}</p>
                            <div class="flex justify-between text-sm text-gray-600 mb-4">
                                <span>👥 {{ $campaign->jumlah_donatur}} Donatur</span>
                                <span>
                                    ⏰ {{ $hariTersisa > 0 ? round($hariTersisa) . ' hari lagi' : 'Berakhir' }}
                                </span>
                            </div>
                            <button class="w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600 transition">Donasi Sekarang</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-tombol my-5"></div>
        <div class="mt-6">
            {{ $campaignAktif->links('components.modern-pagination') }}
            </div>

            {{-- Campaign Berakhir --}}
            
 </div>
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 animate-slide-up" style="animation-delay: 0.3s">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">🛑 Campaign Berakhir</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($campaignBerakhir as $campaign)
                    @php
                        $jumlahDonatur = $campaign->donasi->pluck('id_donatur')->unique()->count();
                    @endphp
                    <div class="bg-gray-100 rounded-2xl shadow-inner transition overflow-hidden border border-gray-300">
                         <div class="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                            <img src="{{ asset('storage/' . $campaign->gambar_campaign) }}" alt="Gambar Campaign" class="object-contain h-full w-full">
                        </div>
                        <div class="p-6">
                            <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-full mb-2">{{ $campaign->kategori->nama_kategori ?? 'Kategori' }}</span>
                            <h3 class="font-bold text-xl text-gray-800">{{ $campaign->judul_campaign }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ $campaign->deskripsi }}</p>
                            <div class="flex justify-between text-sm text-gray-600 mb-4">
                                <span>👥 {{ $jumlahDonatur }} Donatur</span>
                                <span>⏰ Berakhir</span>
                            </div>
                            <button class="w-full bg-gray-400 text-white py-2 rounded-xl cursor-not-allowed" disabled>Donasi Ditutup</button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="border-t border-tombol my-5"></div>
                <div class="mt-6">
                    {{ $campaignBerakhir->links('components.modern-pagination') }}
                </div>
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