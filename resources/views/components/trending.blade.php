
<div class="bg-white rounded-xl shadow-sm p-6">
    <h3 class="text-xl font-bold text-gray-900 mb-4">Artikel Populer</h3>
    <div class="border-t border-tombol my-2"></div>
    <div class="space-y-4">
        @foreach ($trendingKegiatan as $kegiatan)
            <div class="flex gap-3  hover:bg-orange-100">
                <img src="{{ $kegiatan->dokumentasi_kegiatan ? asset('storage/' . $kegiatan->dokumentasi_kegiatan) : 'https://via.placeholder.com/60x60' }}"
                     alt="{{ $kegiatan->judul }}"
                     class="w-12 h-12 object-cover rounded-lg flex-shrink-0">
                <div>
                    <a href="{{ route('kegiatan.detail', $kegiatan->slug) }}" class="font-medium text-gray-900 text-sm leading-tight mb-1 hover:text-tombol">
                        {{ \Str::limit($kegiatan->judul, 50) }}
                    </a>
                    <p class="text-xs text-gray-500">{{ number_format($kegiatan->views) }} views</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
