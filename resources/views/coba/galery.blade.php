<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galery Kegiatan</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="max-w-full mx-auto">
        <!-- Header -->
        <div class="container bg-navbar max-w-full py-7 ">
            <h2 class="text-xl font-bold text-center">GALERY KEGIATAN NIRLABA</h2>
        </div>
      </div>
      

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 p-6">
        @foreach($uploads as $upload)
            <figure class="relative group">
                <a href="#">
                    <img class="rounded-lg transition-all duration-300 w-full aspect-[4/3] object-contain bg-gray-100"
                         src="{{ asset('storage/' . $upload->gambar) }}" 
                         alt="{{ $upload->judul }}">
                </a>
                
                <!-- Efek overlay hitam saat hover -->
                <div class="absolute inset-0 bg-black opacity-0 transition-opacity duration-300 group-hover:opacity-50 rounded-lg"></div>
                
                <!-- Judul utama yang muncul saat hover -->
                <figcaption class="absolute px-4 text-lg text-white bottom-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100 text-center w-full">
                    <p>{{ $upload->judul }}</p>
                </figcaption>
              
                <!-- Caption tanggal yang muncul saat hover -->
                <span class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-sm px-2 py-1 rounded opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                    {{ \Carbon\Carbon::parse($upload->tanggal_upload)->format('d M Y') }}
                </span>
            </figure>
        @endforeach
    </div>
    
      
          
          
</body>
</html>