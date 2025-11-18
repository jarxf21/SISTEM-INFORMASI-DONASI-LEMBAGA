<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan->judul }}</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>
<body class="bg-ivory">
     @include('components.header')
    <div class="max-w-6xl mx-auto p-5">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">            
                <article class="bg-white rounded-lg shadow-lg p-6">
                       <!-- Post Image -->
                    @if($kegiatan->dokumentasi_kegiatan)
                        <img src="{{ asset('storage/' . $kegiatan->dokumentasi_kegiatan) }}" class="w-full h-auto rounded-lg mb-6" alt="{{ $kegiatan->judul }}">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center mb-6">
                            <span class="text-gray-500">FOTO KEGIATAN</span>
                        </div>
                    @endif
                  <!-- Post Meta -->
        <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
        {{-- Admin --}}
        <div class="flex items-center gap-1">
            <img src="{{ asset('image/post/profile.png') }}" alt="Admin" class="w-4 h-4">
            <span class="uppercase">{{ $kegiatan->admin->username ?? 'Admin' }}</span>
        </div>

    <div class="h-4 w-px bg-orange-400"></div>

    {{-- Kategori --}}
    <div class="flex items-center gap-1">
        <img src="{{ asset('image/post/categories.png') }}" alt="Kategori" class="w-4 h-4">
        <span class="uppercase">{{ $kegiatan->kategori->nama_kategori }}</span>
    </div>

    <div class="h-4 w-px bg-orange-400"></div>

    {{-- Tanggal --}}
    <div class="flex items-center gap-1">
        <img src="{{ asset('image/post/calendar.png') }}" alt="Tanggal" class="w-4 h-4">
        <time datetime="{{ $kegiatan->created_at->toIso8601String() }}">
            {{ \Carbon\Carbon::parse($kegiatan->created_at)->translatedFormat('d F Y - H:i') }}
        </time>
    </div>
</div>


                    <!-- Post Title -->
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">
                        {{ $kegiatan->judul }}
                    </h1>

                    <!-- Post Content -->
                    <div class="prose max-w-none text-justify leading-relaxed">
                        {!!($kegiatan->deskripsi_lengkap) !!}
                    </div>
            <!-- Ringkasan Hasil Donasi -->
@if($kegiatan->campaign)
<section class="bg-orange-50 border border-orange-200 rounded-lg p-6 mb-6">
    <h2 class="text-xl font-bold text-tombol mb-4">📊 Ringkasan Hasil Donasi</h2>

    {{-- Total Donasi Uang --}}
    @if(($kegiatan->campaign?->donasis?->count() ?? 0) > 0)
        @php
            $totalUang = $kegiatan->campaign->donasis->sum('jumlah_donasi');
        @endphp
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">💰 Total Donasi Uang</h3>
            <p class="text-gray-700 text-base">
                Rp {{ number_format($totalUang, 0, ',', '.') }}
            </p>
        </div>
    @endif

    {{-- Total Donasi Barang --}}
   {{-- Total Donasi Barang --}}
@if(($kegiatan->campaign?->donasiBarangs?->count() ?? 0) > 0)
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">📦 Total Donasi Barang</h3>
        <ul class="space-y-1 text-gray-700">
            @foreach(
                $kegiatan->campaign->donasiBarangs
                    ->groupBy(fn($item) => $item->kategoriBarang->nama_kategori_barang ?? 'Tidak Berkategori')
                as $kategori => $items
            )
                <li class="mb-2">
                    <p class="font-semibold text-tombol">{{ $kategori }}</p>
                    <ul class="ml-4 list-disc text-gray-700">
                        @foreach($items->groupBy('nama_barang') as $namaBarang => $barangItems)
                            @php
                                $total = $barangItems->sum('jumlah');
                                // Ambil satuan dari entri pertama di grup barang tersebut
                                $satuan = $barangItems->first()->satuan ?? '';
                            @endphp
                            <li class="flex justify-between border-b border-gray-100 pb-1">
                                <span>{{ $namaBarang }}</span>
                                <span class="font-bold">{{ $total }} {{ $satuan }}</span>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
@endif

    {{-- Jika belum ada donasi sama sekali --}}
    @if(($kegiatan->campaign?->donasis?->count() ?? 0) === 0 && ($kegiatan->campaign?->donasiBarangs?->count() ?? 0) === 0)
        <p class="text-gray-500 italic">Belum ada donasi yang tercatat untuk kegiatan ini.</p>
    @endif
</section>
@endif

              
                </article>
                  <!-- Related Posts -->
                  <div class="border-t border-tombol my-5"></div>
        {{-- <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">KEGIATAN SERUPA LAINNYA</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ">
                @foreach(App\Models\Kegiatan::where('id_kategori', $kegiatan->id_kategori)->where('id_kegiatan', '!=', $kegiatan->id_kegiatan)->take(3)->get() as $related)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:bg-orange-200">
                    <a href="{{ route('kegiatan.detail', $related->slug) }}">
                        @if($related->dokumentasi_kegiatan)
                            <img src="{{ asset('storage/' . $related->dokumentasi_kegiatan) }}" class="w-full h-48 object-cover" alt="{{ $related->judul }}">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">FOTO KEGIATAN</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-md font-bold text-gray-800 mb-2  hover:text-tombol">
                                {{ $related->judul }}
                            </h3>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($related->tanggal_upload)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div> --}}
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Kegiatan Terbaru -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="relative text-lg font-bold text-gray-800 mb-4">Kegiatan Terbaru</h3>

                    <div class="border-t border-tombol my-3"></div>
                    <div class="space-y-4">
                        @foreach(App\Models\Kegiatan::latest()->take(3)->get() as $recent)
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10">
                                <img src="{{ asset('storage/' . $recent->dokumentasi_kegiatan) }}" alt="gambar" class="object-cover rounded-full">
                                
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('kegiatan.detail', $recent->slug) }}" class="">
                                <p class="text-sm font-medium  text-gray-700 hover:bg-orange-50 hover:text-tombol rounded-lg transition-colors">{{ $recent->judul }}</p>
                                </a>
                                <p class="text-xs text-gray-500">{{ $recent->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                       
                        @endforeach
                    </div>
                </div>

                <!-- Daftar Program -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Kategori</h3>
                    <div class="space-y-2">
                        @foreach(App\Models\KategoriKegiatan::all() as $kategori)
                            <a href="{{ route('kegiatan.byKategori', $kategori->slug) }}" class="block p-3 text-gray-700 hover:bg-orange-100 hover:text-tombol rounded-lg transition-colors font-medium">
                                {{ $kategori->nama_kategori }}
                            </a>
                            <div class="border-t border-tombol "></div>
                        @endforeach
                    </div>
                </div>

                <!-- Kegiatan Populer -->
                 @include('components.trending')
            </div>
        </div>

      
    </div>
    @include("components.footer")
</body>
</html>
