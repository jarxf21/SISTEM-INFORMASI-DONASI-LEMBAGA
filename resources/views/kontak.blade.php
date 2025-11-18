<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Sahabat Ummat</title>
      @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
  
</head>
<body>
    @include("components.header")
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Peta Section -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="relative">
                    <!-- Placeholder untuk peta - dalam implementasi nyata gunakan Google Maps API -->
                                        <!-- Google Maps Embed -->
                    <div class="w-full h-96">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.812694611757!2d109.38329137403936!3d-0.0962167354813047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d513a5adce87d%3A0xe617c69f07959a90!2sSAHABAT%20UMMAT%20Home!5e0!3m2!1sid!2sid!4v1754358949394!5m2!1sid!2sid" 
                            class="w-full h-full rounded-lg shadow-lg border-0"
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Informasi Kontak Section -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Kontak Lembaga Sahabat Ummat</h1>
                    <p class="text-gray-600 mb-6">Kami berkomitmen menghadirkan solusi atas persoalan kemanusiaan, pendidikan, dan pemberdayaan secara berkelanjutan demi terciptanya masyarakat yang sejahtera dan mandiri.</p>
                    
                    <!-- Lokasi Organisasi -->
                    <div class="mb-6">
                        <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-map-marker-alt text-gray-600 mr-3"></i>
                            Lokasi Lembaga
                        </h2>
                        <p class="text-gray-600 ml-6">Jalan Parit Nomor Dua Gg.Langsat 1 Nomor 8, Kuburaya, Kalimantan Barat</p>
                    </div>

                   <!-- Gmail -->
                    <div class="mb-6">
                        <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-envelope text-gray-600 mr-3"></i>
                            Gmail
                        </h2>
                        <a href="mailto:{{ $kontak->nama_email }}"class="text-gray-600 ml-6" >{{ $kontak->nama_email ?? '-' }}</a>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-6">
                        <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-phone text-gray-600 mr-3"></i>
                            Nomor Telepon/WhatsApp
                        </h2>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->nomor_wa ?? '') }}" target="_blank" class="text-blue-500 ml-6 hover:underline">
                            {{ $kontak->nomor_wa ?? '-' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kontak Cepat -->

    </div>
    @include("components.footer")

    <script>
    </script>
</body>
</html>