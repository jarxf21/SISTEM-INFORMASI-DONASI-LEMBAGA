@vite('resources/css/app.css')
@vite(['resources/js/app.js'])

<x-filament::page>
    <div class="space-y-8">
        
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard Kegiatan</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola dan pantau performa kegiatan Anda</p>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Total Kegiatan --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Kegiatan</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $this->getTotalKegiatan() }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    {{-- <span class="text-green-600 dark:text-green-400 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        +{{ $this->getKegiatanBulanIni() }}
                    </span> --}}
                    <span class="text-gray-600 dark:text-gray-400 ml-2">Total kegiatan seluruh kategori</span>
                </div>
            </div>

            {{-- Total Views --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Views</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($this->getTotalViews()) }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900 dark:to-green-800 rounded-xl">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                   
                    <span class="text-gray-600 dark:text-gray-400 ml-2"> Total Views seluruh kegiatan</span>
                </div>
            </div>

            {{-- Kegiatan Bulan Ini --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kegiatan Bulan Ini</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $this->getKegiatanBulanIni() }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900 dark:to-purple-800 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kegiatan yang terlaksana</p>
                </div>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Top 3 Kegiatan --}}
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Top 3 Kegiatan Paling Populer</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kegiatan dengan views tertinggi</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($this->getKegiatan() as $index => $kegiatan)
                                <div class="group flex items-center p-5 bg-gradient-to-r from-gray-50 to-white dark:from-gray-700 dark:to-gray-800 rounded-xl border border-gray-200 dark:border-gray-600 hover:shadow-lg hover:border-gray-300 dark:hover:border-gray-500 transition-all duration-300">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg
                                            {{ $index == 0 ? 'bg-gradient-to-r from-yellow-400 to-yellow-600' : 
                                               ($index == 1 ? 'bg-gradient-to-r from-gray-400 to-gray-600' : 
                                                'bg-gradient-to-r from-orange-400 to-orange-600') }}">
                                            {{ $index + 1 }}
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-semibold text-gray-900 dark:text-white text-lg group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                            {{ $kegiatan->judul }}
                                        </h4>
                                        <div class="flex items-center gap-4 mt-3 text-sm text-gray-600 dark:text-gray-400">
                                            <span class="flex items-center bg-blue-50 dark:bg-blue-900 px-3 py-1 rounded-full">
                                                <svg class="w-4 h-4 mr-1.5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="font-medium text-blue-800 dark:text-blue-300">{{ number_format($kegiatan->views) }} views</span>
                                            </span>
                                            @if($kegiatan->kategori)
                                                <span class="px-3 py-1 bg-gradient-to-r from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800 text-primary-800 dark:text-primary-300 rounded-full text-xs font-medium">
                                                    {{ $kegiatan->kategori->nama_kategori }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                                    <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-lg font-medium">Belum ada kegiatan</p>
                                    <p class="text-sm mt-1">Kegiatan yang Anda buat akan muncul di sini</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                
                {{-- Statistik Kategori --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-primary-50 to-primary-100 dark:from-primary-900 dark:to-primary-800">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Statistik Kategori</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Views per kategori</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($this->getKategoriStats() as $kategori)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-gradient-to-r from-primary-400 to-primary-600 rounded-full"></div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $kategori->nama_kategori }}</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900 dark:text-white bg-white dark:bg-gray-800 px-2 py-1 rounded-full">
                                        {{ $kategori->kegiatan_count }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                    <p class="text-sm">Belum ada data kategori</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Kegiatan Terbaru --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900 dark:to-green-800">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kegiatan Terbaru</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Aktivitas terkini</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($this->getKegiatanTerbaru() as $kegiatan)
                                <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                    <div class="w-2 h-2 bg-gradient-to-r from-green-400 to-green-600 rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                                    <div class="flex-grow min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2">{{ $kegiatan->judul }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $kegiatan->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                    <p class="text-sm">Belum ada kegiatan terbaru</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-filament::page>