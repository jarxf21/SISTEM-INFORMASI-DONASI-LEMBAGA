    {{-- Hero section
    <section id="home" class="pt-20 lg:pt-36 bg-back">
      <div class="container px-6 lg:px-4 mx-auto">
          <div class="flex flex-col-reverse lg:flex-row items-center">
              
              <!-- Bagian Teks -->
              <div class="w-full lg:w-1/2 text-center lg:text-left">
                  <h1 class="font-bold text-slate-900 text-4xl sm:text-5xl lg:text-6xl mt-4">SAHABAT UMMAT</h1>
                  <h1 class="font-bold text-slate-900 text-3xl sm:text-4xl lg:text-5xl py-3">NIRLABA</h1>
                  <p class="font-semibold text-slate-700 text-lg sm:text-2xl pb-6">
                      "Donasikan Barang Tebarkan Kebaikan"
                  </p>
                  <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                      <a href="manfaat" class="text-base font-semibold py-3 px-6 text-white bg-tombol rounded-full
                      hover:shadow-lg hover:bg-tombol hover:opacity-75">Ayo Mulai</a>
                      <a href="kontak" class="text-base font-semibold py-3 px-6 text-white bg-tombol rounded-full
                      hover:shadow-lg hover:bg-tombol hover:opacity-75 ">Hubungi Kami</a>
                  </div>
              </div>
  
              <!-- Bagian Gambar -->
              <div class="w-full lg:w-1/2">
                  <img src="{{ asset('image/hero.png') }}" alt="gambar" class="max-w-full mx-auto">
              </div>
  
          </div>
      </div>
  </section> --}}
  {{-- manfaat section --}}
  <div class="container bg-second max-w-8xl mx-auto px-6 py-7 rounded-lg mt-8">
    <h1 class="text-4xl font-bold text-center">MANFAAT NIRLABA</h1>
  </div>
  
  <section id="manfaat" class="py-10 flex justify-center items-center">
    <div class="grid grid-cols-3 gap-6 items-center max-w-6xl mx-auto">   
      <!-- Keterangan Kiri -->
      <div class="flex flex-col space-y-20 text-right">
        <div class="bg-back px-4 py-3 rounded-full shadow-md delay-[200ms] duration-[600ms] taos:translate-x-[-100%] taos:opacity-0" data-taos-offset="400">
          <p class="lg:text-lg md:text-lg font-semibold xs:text-xs" >Memberikan Bantuan kepada yang Membutuhkan</p>
       </div>
        <div class="bg-back px-4 py-3 rounded-full shadow-md delay-[200ms] duration-[600ms] taos:translate-x-[100%] taos:opacity-0" data-taos-offset="400">
          <p class="lg:text-lg md:text-lg font-semibold  xs:text-xs">Memberikan Berkah untuk Diri dan Orang Lain</p>
        </div>
      </div>
  
      <!-- Gambar di Tengah -->
      <div class="flex justify-center">
        <img src="{{ asset('image/manfaat.png') }}" alt="gambar" class="lg:max-w-[600px] xs:max-w-[200px] mx-auto ">
      </div>
  
      <!-- Keterangan Kanan -->
      <div class="flex flex-col space-y-20 text-left">
        <div class="bg-back px-4 py-3 rounded-full shadow-md delay-[200ms] duration-[600ms] taos:translate-x-[100%] taos:opacity-0" data-taos-offset="400">
          <p class="lg:text-lg md:text-lg font-semibold  xs:text-xs">Menginspirasi Kebaikan yang Berkelanjutan</p>
        </div>
        <div class="bg-back px-4 py-3 rounded-full shadow-md delay-[200ms] duration-[600ms] taos:translate-x-[100%] taos:opacity-0" data-taos-offset="400">
          <p class="lg:text-lg md:text-lg font-semibold  xs:text-xs ">Meningkatkan Kesadaran Sosial</p>
        </div>
      </div>
  </section>

<section id="Gallery">
      {{-- GALERY KEGIATAN --}}
      <div class="max-w-full mx-auto">
        <!-- Header -->
        <div class="container bg-second max-wfull mx-auto px-6 py-7 ">
            <h2 class="text-xl font-bold text-center">GALERY KEGIATAN NIRLABA</h2>
        </div>

        <!-- Galeri -->
        <div class=" flex justify-center mt-8 duration-[1000ms] taos:opacity-0" data-taos-offset="300">
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-32 xs:gap-10">
              <div class="w-64 h-64 bg-gray-300 flex items-center justify-center text-gray-600 text-lg">
                  foto
              </div>
              <div class="w-64 h-64 bg-gray-300 flex items-center justify-center text-gray-600 text-lg">
                  foto
              </div>
              <div class="w-64 h-64 bg-gray-300 flex items-center justify-center text-gray-600 text-lg">
                  foto
              </div>
          </div>
      </div>
      
        <!-- Tombol -->
        <div class="text-center mt-6">
            <button class="bg-tombol text-white font-semibold py-2 px-6 rounded-md hover:bg-orange-600">
                <a href="/galeri_kegiatan">LIHAT SEMUA</a>
            </button>
        </div>
    </div>
  </div>
</section>  

<section id="Kontak"  >
  <footer class="bg-navbar mt-12 py-6 px-8">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
        <!-- Teks -->
        <h1 class="font-bold text-5xl md:text-left text-center md:pl-10">HUBUNGI KAMI</h1>
        
        <!-- Gambar -->
        <div class="mt-4 md:mt-0">
            <img src="{{ asset('image/wa.png') }}" alt="gambar" 
                class="lg:max-w-[200px] xs:max-w-[120px] mx-auto md:mx-0">
                <h1 class="font-bold text-2xl  md:pl-5">089670180221</h1>
        </div>
    </div>
</footer>

</div>
</section>
 </footer>