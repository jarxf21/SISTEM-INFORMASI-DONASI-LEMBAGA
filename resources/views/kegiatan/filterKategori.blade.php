<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kegiatan Detail</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>
<body class="bg-ivory">

    {{-- main section --}}
   @include('components.header')
    <div class="max-w-7xl mx-auto p-4 lg:p-6 ">
        
                <!-- Header dengan gambar besar -->
               <header class="relative bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl overflow-hidden mb-8">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
            <img src="https://picsum.photos/1200/400?random=1" alt="Header Image" class="absolute inset-0 w-full h-full object-cover opacity-50">
            <div class="relative z-10 text-center py-24 px-6">
                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4">Kegiatan</h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">Kegiatan Berdasarkan Kategori Yang di lakukan Lembaga Sahabat Ummat</p>
            </div>
        </header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <main class="lg:col-span-2">
    @if(isset($kategoriDipilih))
        <h1 class="text-2xl font-bold text-gray-900 mb-6">
            Menampilkan Kegiatan Kategori: <span class="text-tombol">{{ $kategoriDipilih->nama_kategori }}</span>
        </h1>
    @endif

    @forelse ($kegiatan as $item)
        <article class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <img src="{{ asset('storage/' . $item->dokumentasi_kegiatan) }}" alt="{{ $item->judul }}" class="w-full h-64 object-cover rounded-lg mb-6">
            {{-- post meta --}}
                <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
                    <div class="flex items-center gap-1">
                    <img src="{{ asset('image/post/profile.png') }}" alt="Admin" class="w-4 h-4">
                    <span>{{ $item->admin->username ?? 'Admin' }}</span>
                </div>
                   <div class="h-4 w-px bg-orange-400"></div>
                {{-- Kategori --}}
                <div class="flex items-center gap-1">
                    <img src="{{ asset('image/post/categories.png') }}" alt="Kategori" class="w-4 h-4">
                    <span class="uppercase">{{ $item->kategori->nama_kategori }}</span>
                </div>
                <div class="h-4 w-px bg-orange-400"></div>
                {{-- Tanggal --}}
                <div class="flex items-center gap-1">
                    <img src="{{ asset('image/post/calendar.png') }}" alt="Tanggal" class="w-4 h-4">
                   <span>{{ $item->created_at->format('F j, Y - H:i') }}</span>
                </div>
                    
                </div>

            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">{{ $item->judul }}</h2>
            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                {{ Str::limit(strip_tags($item->deskripsi_lengkap), 150) }}
            </p>
            <a href="{{ route('kegiatan.detail', $item->slug) }}" class="inline-flex items-center text-tombol hover:text-orange-700 font-semibold">
                Baca selengkapnya
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </article>
    @empty
        <p class="text-gray-500">Tidak ada kegiatan pada kategori ini.</p>
        <div class="border-t border-tombol my-5"></div>
    @endforelse
                <div class="mt-6">
                {{ $kegiatan->links('components.modern-pagination') }}
            </div>
</main>
            {{-- samping kanan --}}
            <aside class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kategori</h3>
                    @foreach($kategori as $kat)
                    <a href="{{ url('/kegiatan/' . $kat->slug) }}" class="block p-3 text-gray-700 hover:bg-orange-100 hover:text-tombol rounded-lg transition-colors font-medium">
                        {{ $kat->nama_kategori }}
                    </a>
                    <div class="border-t border-tombol"></div>
                    @endforeach
                </div>
                 <!-- Widget Artikel Populer -->
                 @include('components.trending')

                </div>
            </aside>
</div>
@include("components.footer")
</body>

</html>

