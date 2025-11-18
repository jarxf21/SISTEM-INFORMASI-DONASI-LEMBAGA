{{-- @vite('resources/css/app.css')
@vite(['resources/js/app.js']) --}}
{{-- resources/views/filament/admin/widgets/campaign-cards-widget.blade.php --}}
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-6">
            {{-- Header dengan filter kategori --}}
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $this->getHeading() ?? 'Kampanye Terbaru' }}
                </h2>
                
                {{-- Filter kategori (opsional) --}}
                <div class="flex space-x-2">
                    <x-filament::badge color="primary" size="sm">
                        Total: {{ $campaigns->total() }} Kampanye
                    </x-filament::badge>
                </div>
            </div>

            {{-- Grid Cards --}}
            @if($campaigns->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($campaigns as $campaign)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                            {{-- Gambar Campaign --}}
                            <div class="relative h-48 bg-gray-200 dark:bg-gray-700">
                                @if($campaign->gambar_campaign)
                                    <img 
                                        src="{{ asset('storage/campaigns/' . $campaign->gambar_campaign) }}" 
                                        alt="{{ $campaign->judul_campaign }}"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Badge kategori --}}
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getCategoryColor($campaign->kategori->nama_kategori ?? 'Lainnya') }}">
                                        {{ $campaign->kategori->nama_kategori ?? 'Lainnya' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Konten Card --}}
                            <div class="p-4">
                                {{-- Judul --}}
                                <h3 class="font-semibold text-gray-900 dark:text-white text-sm mb-2 line-clamp-2">
                                    {{ $campaign->judul_campaign }}
                                </h3>

                                {{-- Deskripsi singkat --}}
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                    {{ Str::limit($campaign->deskripsi, 80) }}
                                </p>

                                {{-- Status dan waktu tersisa --}}
                                <div class="flex justify-between items-center mb-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($campaign->status_campaign) }}">
                                        {{ ucfirst($campaign->status_campaign) }}
                                    </span>
                                    
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $this->getDaysRemaining($campaign->tanggal_selesai) }}
                                    </span>
                                </div>

                                {{-- Progress Bar --}}
                                {{-- <div class="mb-3">
                                    <div class="flex justify-between text-xs mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">Progress</span>
                                        <span class="text-gray-900 dark:text-white font-semibold">{{ number_format($campaign->progress, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div 
                                            class="h-2 rounded-full transition-all duration-300 {{ $campaign->progress >= 100 ? 'bg-green-500' : ($campaign->progress >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}" 
                                            class="width: {{ min($campaign->progress, 100) }}%"
                                        ></div>
                                    </div>
                                </div> --}}

                                {{-- Informasi Donasi --}}
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-600 dark:text-gray-400">
                                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $campaign->jumlah_donatur }} Donatur
                                        </span>
                                        <span class="text-xs font-semibold text-gray-900 dark:text-white">
                                            Terkumpul: {{ $this->formatCurrency($campaign->terkumpul) }}
                                        </span>
                                    </div>
                                    
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        Target: {{ $this->formatCurrency($campaign->target_donasi) }}
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                {{-- <div class="mt-4 flex space-x-2">
                                    <a 
                                        href="{{ route('filament.admin.resources.campaigns.view', $campaign) }}"
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium py-2 px-3 rounded-md text-center transition-colors duration-200"
                                    >
                                        Lihat Detail
                                    </a>
                                    <a 
                                        href="{{ route('filament.admin.resources.campaigns.edit', $campaign) }}"
                                        class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-medium py-2 px-3 rounded-md text-center transition-colors duration-200"
                                    >
                                        Edit
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $campaigns->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada kampanye</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai dengan membuat kampanye pertama Anda.</p>
                    <div class="mt-6">
                        <a 
                            href="{{ route('filament.admin.resources.campaigns.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Buat Kampanye Baru
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>