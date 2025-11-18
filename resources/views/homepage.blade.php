<!doctype html>
<html  class="scroll-smooth">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <script>document.documentElement.classList.add('js')</script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
      @keyframes ripple {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-8px);
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }
            100% {
                background-position: calc(200px + 100%) 0;
            }
        }
        
        .ripple-effect {
            position: relative;
            overflow: hidden;
        }
        
        .ripple-effect::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .ripple-effect:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            background-size: 200px 100%;
            animation: shimmer 2s infinite;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #B3E0EE, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-effect {
            background: rgba(179, 224, 238, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(179, 224, 238, 0.2);
        }
      .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .bg-tombol:hover {
            background-color: #e55a00;
        }
        
        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }
        .fancy-corners {
            position: relative;
            background: linear-gradient(135deg, #ea580c 0%, #fb923c 100%);
        }
        
        .fancy-corners::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 60px;
            height: 60px;
            background:  #5AA7C4;
            clip-path: polygon(0 0, 100% 0, 0 100%);
        }
        
        .fancy-corners::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
            height: 60px;
            background: #5AA7C4;
            clip-path: polygon(100% 0, 100% 100%, 0 100%);
        }
        
        .flex-basis-40 {
            flex-basis: 40%;
        }
        
        .flex-basis-50 {
            flex-basis: 50%;
        }
        
        .flex-basis-60 {
            flex-basis: 60%;
        }
        
        @media (min-width: 1280px) {
            .xl\:flex-basis-60 {
                flex-basis: 60%;
            }
        }
        
        @media (min-width: 640px) {
            .sm\:flex-basis-40 {
                flex-basis: 40%;
            }
        }
        
        @media (min-width: 768px) {
            .md\:flex-basis-50 {
                flex-basis: 50%;
            }
        }
                @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        /* .program-card {
            animation-delay: var(--delay);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-gradient {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        } */
    </style>
  </head>
  <body>
    
    {{-- top header --}}
     @include('components.header')
    <!-- Header Top -->
<!-- Bagian Atas: Alamat + Sosial Media -->
<div class="overflow-x-hidden overflow-y-hidden">
    <section class="bg-white py-10  ">
    <div class="container mx-auto flex justify-between items-center px-4 text-sm text-black">
        <!-- Alamat -->
        <div class="flex gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.5 1.5 0 01-2.121 0l-4.243-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span><p class="font-semibold md:text-xl xs:text-xl">Jalan Parit Nomor dua, Gang Langsat 1, Kab. Kuburaya, Kalimantan Barat</p></span>
        </div>
        <!-- Sosial Media -->
        {{-- <div class="flex items-center gap-4">
        <a href="#" class="text-black-600 hover:text-black"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-black-600 hover:text-black"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-black-600 hover:text-black"><i class="fab fa-instagram"></i></a>
        </div> --}}
    </div>
    </section>

    <!-- Bagian Tengah: Logo + Info -->
    <section class="bg-back py-6 border-b ">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 gap-4">

        <!-- Logo -->
        <div class="w-[200px]">
        <img src="{{ asset('image/logo.png') }}" alt="Logo sahabat ummat" class="w-full">
        </div>

        <!-- Info -->
        <div class="flex flex-col md:flex-row items-center gap-6 text-center md:text-left text-sm">
        
        <!-- Kontak -->
        <div>
            <p class="text-gray-600 text-lg">Kontak Kami</p>
            <p class="font-semibold text-2xl">+{{ $kontak->nomor_wa }}</p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-10 bg-gray-300"></div>

        <!-- Email -->
        <div>
            <p class="text-gray-600 text-lg">Alamat Email</p>
            <p class="font-semibold text-2xl">{{ $kontak->nama_email }}</p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-10 bg-gray-300"></div>

        <!-- Tahun Berdiri -->
        <div>
            <p class="text-gray-600 text-lg">Tahun Berdiri</p>
            <p class="font-semibold text-2xl">18 Februari 2018</p>
        </div>

        <!-- Tombol -->
        {{-- <div>
            <a href="#" class="bg-orange-500 text-white px-7 py-5 rounded hover:bg-orange-600 transition">
            Tanya Kami
            </a>
        </div> --}}
        </div>
    </div>
    </section>
        </section>

            {{-- hero section --}}
       
    <section class="relative w-full h-screen bg-cover bg-center " 
            style="background-image: url('{{ asset('storage/' . $hero->gambar) }}');"
            data-aos="zoom-in" 
            data-aos-duration="1500">
        
        <!-- Overlay agar teks lebih terbaca -->
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

        <!-- Konten Kotak Kiri -->
        <div class="relative z-10 container mx-auto h-full flex items-center px-6">
            <div class="bg-white bg-opacity-90 p-6 md:p-10 max-w-lg rounded-lg shadow-lg"
                data-aos="fade-right" 
                data-aos-duration="1000" 
                data-aos-delay="500">
                
                <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-4"
                    data-aos="fade-up" 
                    data-aos-duration="800" 
                    data-aos-delay="800">
                    Lembaga Sahabat Ummat
                </h1>
                
                <p class="text-gray-700 text-md md:text-lg"
                data-aos="fade-up" 
                data-aos-duration="600" 
                data-aos-delay="300">
                    Sahabat Ummat adalah lembaga sosial yang berdiri atas dasar kepedulian dan semangat kebersamaan.
                    Kami berkomitmen untuk menjadi penghubung antara kebaikan hati para dermawan dan mereka yang membutuhkan uluran tangan. 
                    Melalui <span class="text-tombol"><a href="#program">program-program kami </a></span>Sahabat Ummat terus berupaya menyalurkan amanah dengan transparan, amanah, dan penuh tanggung jawab.
                    Kami percaya bahwa sekecil apa pun kontribusi, bila dilakukan bersama, akan membawa perubahan besar. Jadilah bagian dari perjalanan kebaikan ini.
                </p>
            </div>
        </div>
    </section>

        </header-top>
        {{-- navbar --}}
    
        
    {{-- VISI DAN MISI --}}
    <section class="bg-back dark:bg-orange-400 text-black py-16 px-6 md:px-16">
        {{-- VISI --}}
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="order-2 md:order-1"
                data-aos="fade-right" 
                data-aos-duration="1000" 
                data-aos-offset="200">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 relative">
                    <span class="relative z-10">Visi Kami</span>
                    <div class="absolute -bottom-2 left-0 w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-300 rounded-full"
                        data-aos="scale-x-100" 
                        data-aos-duration="800" 
                        data-aos-delay="300"></div>
                </h2>
                <p class="text-lg leading-relaxed text-justify tracking-wide transform transition-all duration-300 hover:scale-105"
                data-aos="fade-left" 
                data-aos-duration="800" 
                data-aos-delay="200"
                data-aos-offset="150">
                    Menjadi lembaga sosial terpercaya yang hadir sebagai sahabat bagi umat. Kami berkomitmen menghadirkan solusi atas persoalan kemanusiaan, pendidikan, dan pemberdayaan secara berkelanjutan demi terciptanya masyarakat yang sejahtera dan mandiri.
                </p>
            </div>
            <div class="order-1 md:order-2 flex justify-center"
                data-aos="fade-left" 
                data-aos-duration="1000" 
                data-aos-offset="200">
                <div class="relative group">
                    <img src="{{ asset('image/visi.jpg') }}" alt="Visi Sahabat Ummat"
                        class="w-full max-w-md md:max-w-lg h-auto rounded-lg shadow-lg object-cover transform transition-all duration-500 group-hover:scale-105 group-hover:shadow-2xl" 
                        style="aspect-ratio: 16/9;">
                    <div class="absolute inset-0 bg-gradient-to-t from-orange-900/20 to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </div>
        </div>

        {{-- MISI --}}
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center mt-16">
            <div class="flex justify-center"
                data-aos="fade-right" 
                data-aos-duration="1000" 
                data-aos-offset="200">
                <div class="relative group">
                    <img src="{{ asset('image/misi.jpg') }}" alt="Misi Sahabat Ummat"
                        class="w-full max-w-md md:max-w-lg h-auto rounded-lg shadow-lg object-cover transform transition-all duration-500 group-hover:scale-105 group-hover:shadow-2xl" 
                        style="aspect-ratio: 16/9;">
                    <div class="absolute inset-0 bg-gradient-to-t from-orange-900/20 to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </div>
            <div data-aos="fade-left" 
                data-aos-duration="1000" 
                data-aos-offset="200">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 relative">
                    <span class="relative z-10">Misi Kami</span>
                    <div class="absolute -bottom-2 left-0 w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-300 rounded-full"
                        
                        data-aos-duration="300" 
                        data-aos-delay="300"></div>
                </h2>
                <ul class="text-lg leading-relaxed list-none space-y-3"
                        data-aos="fade-up" 
                        data-aos-duration="300" 
                        data-aos-delay="300"
                        data-aos-offset="100">
                    <li class="flex items-start transform transition-all duration-300 hover:translate-x-2"
                        >
                        <span class="inline-block w-2 h-2 bg-orange-500 rounded-full mt-3 mr-3 flex-shrink-0"></span>
                        <span>Menyalurkan amanah bantuan secara profesional dan transparan.</span>
                    </li>
                    <li class="flex items-start transform transition-all duration-300 hover:translate-x-2">
                        <span class="inline-block w-2 h-2 bg-orange-500 rounded-full mt-3 mr-3 flex-shrink-0"></span>
                        <span>Mengembangkan program pendidikan dan pemberdayaan masyarakat.</span>
                    </li>
                    <li class="flex items-start transform transition-all duration-300 hover:translate-x-2"
                    >
                        <span class="inline-block w-2 h-2 bg-orange-500 rounded-full mt-3 mr-3 flex-shrink-0"></span>
                        <span>Memberikan solusi jangka panjang untuk kesejahteraan umat.</span>
                    </li>
                    <li class="flex items-start transform transition-all duration-300 hover:translate-x-2"
                        >
                        <span class="inline-block w-2 h-2 bg-orange-500 rounded-full mt-3 mr-3 flex-shrink-0"></span>
                        <span>Menjadi mitra aktif dalam kegiatan sosial dan kemanusiaan.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>



{{-- PROGRAM SECTION --}}
@include('components.kategori', ['programs' => $programs])


{{-- @include("components.kategorV2") --}}


 
{{-- DONASI --}}
<section id="#donasi" class="px-4 md:px-10 lg:px-16">

  <div class="text-center mb-12">
      
      <p class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">
         Donasi di Lembaga Sahabat Ummat saat ini
      </p>
  </div>
<section class="py-10 px-4 bg-back">
<div class="max-w-screen-md mx-auto">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-center">
    <div class="bg-gray-100 shadow-md rounded-xl p-6">
      <h4 class="text-sm text-gray-500 mb-1">Total Donasi</h4>
      <p class="text-2xl font-bold text-green-600">
         Rp {{ number_format($totalDonasi, 0, ',', '.') }}
      </p>
    </div>
    <div class="bg-gray-100 shadow-md rounded-xl p-6">
      <h4 class="text-sm text-gray-500 mb-1">Total Donatur</h4>
      <p class="text-2xl font-bold text-blue-600">{{ $totalDonatur }}</p>
    </div>
    <div class="bg-gray-100 shadow-md rounded-xl p-6">
      <h4 class="text-sm text-gray-500 mb-1">Campaign yang berlangsung saat ini</h4>
      <p class="text-2xl font-bold text-purple-600">{{ $totalCampaignAktif }}</p>
    </div>
  </div>
</div>
</section>


</div>
<div class="bg-blue-100 border-l-4 border-navbar p-6 mb-6 rounded-lg shadow-md flex items-center justify-between max-w-5xl mx-auto mt-4">
  <div>
      <h3 class="text-xl font-bold text-blue-800">Donasi Terkumpul</h3>
      <p class="text-2xl font-semibold text-blue-700">Rp {{ number_format($donasibulanan, 0, ',', '.') }}</p>
     <p class="text-sm text-gray-600">
        Per {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
    </p>
  </div>
  <div class="text-right">
      <button class="mt-2 px-4 py-2 bg-tombol text-white rounded-lg hover:bg-orange-700"><a href="/donasi">Lihat detail</a></button>
  </div>
</div>
  
</section>

{{-- <div class="relative">
 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FF6900" fill-opacity="0.7" d="M0,288L60,272C120,256,240,224,360,218.7C480,213,600,235,720,250.7C840,267,960,277,1080,256C1200,235,1320,181,1380,154.7L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z "></path></svg>
</div> --}}

 {{-- grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 --}}

<section class="py-20 bg-white px-4 md:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">
                Kegiatan Terbaru Kami
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Ikuti berbagai kegiatan sosial dan program bantuan yang kami lakukan untuk membantu sesama
            </p>
        </div>
       
        <!-- MULAI GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($kegiatanterbaru as $item)
                <div class="bg-back rounded-2xl shadow-lg hover:shadow-2xl overflow-x-hidden transition-all duration-300 flex flex-col card-hover group">
                    <div class="relative overflow-x-hidden">
                        <img src="{{ asset('storage/' . $item->dokumentasi_kegiatan) }}" 
                            alt="Kegiatan" 
                            class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                     {{ $kategoriList[$item->id_kategori] ?? 'Tidak ada Kategori' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold mb-2 text-gray-900 group-hover:text-orange-600 transition-colors">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $item->tanggal_upload->format('F j, Y') }}
                        </p>
                        <p class="text-sm text-gray-700 mb-4 flex-1 leading-relaxed">
                            {{ Str::limit(strip_tags($item->deskripsi_lengkap), 150) }}
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                           
                            <a href="{{ route('kegiatan.detail', $item->slug) }}" class="text-tombol font-semibold text-sm hover:underline flex items-center group-hover:text-orange-700 transition-colors">
                                Lihat Selengkapnya 
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Belum ada kegiatan.</p>
            @endforelse
        </div>
        <!-- AKHIR GRID -->
    </div>
</section>

           

{{-- CALL TO ACTIONS --}}
<section class="bg-white">
    <div class="min-h-screen flex flex-col p-8 sm:p-16 md:p-24 justify-center">
        <div class="mx-auto max-w-6xl">
            <h2 class="sr-only">Mari Berdonasi</h2>
            <section class="font-sans text-black">
                <div class="lg:flex lg:items-center fancy-corners shadow-2xl overflow-x-hidden">
                    <!-- Image Section -->
                    <div class="flex-shrink-0 self-stretch sm:flex-basis-40 md:flex-basis-50 xl:flex-basis-60">
                        <div class="h-full min-h-[400px] lg:min-h-[500px]">
                            <article class="h-full">
                                <div class="h-full">
                                    <img 
                                        class="h-full w-full object-cover" 
                                        src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                                        width="733" 
                                        height="500" 
                                        alt="Orang yang sedang membantu" 
                                    />
                                </div>
                            </article>
                        </div>
                    </div>
                    
                    <!-- Content Section -->
                    <div class="p-8 lg:p-12 bg-white/95 backdrop-blur-sm flex-1">
                        <div class="leading-relaxed">
                            <h2 class="leading-tight text-3xl lg:text-4xl font-bold text-gray-800 mb-6">
                                Setiap Donasi Akan Sangat Berarti
                            </h2>
                            
                            <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                                Bergabunglah dengan gerakan kebaikan yang telah mengubah ribuan kehidupan. Donasi Anda akan langsung disalurkan kepada mereka yang membutuhkan bantuan.
                            </p>
                            
                            <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                                Dengan transparansi penuh dan laporan berkala, kami memastikan setiap rupiah donasi Anda sampai ke tangan yang tepat dan memberikan dampak nyata.
                            </p>
                            
                            <div class="mt-8">
                                <a 
                                    class="inline-block bg-tombol hover:bg-orange-700 text-white font-semibold px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl" 
                                    href="/campaign"
                                >
                                    Mulai Berdonasi Sekarang
                                </a>
                            </div>
                            
                            <!-- Stats Section -->
                            <div class="mt-8 grid grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-600">1000+</div>
                                    <div class="text-sm text-gray-500">Orang Terbantu</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-600">10jt+</div>
                                    <div class="text-sm text-gray-500">Dana Terkumpul</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </section>

@include("components.footer")





<script src="https://unpkg.com/taos@1.0.5/dist/taos.js"></script>
  </body>
</html>