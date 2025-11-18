<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet Our Neighbors - Program Carousel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
       
    </style>
</head>

<body class="min-h-screen bg-ivory">
    <section class="min-h-screen bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQ0MCIgaGVpZ2h0PSI2MDAiIHZpZXdCb3g9IjAgMCAxNDQwIDYwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGRlZnM+CjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZGllbnQiIHgxPSIwJSIgeTE9IjAlIiB4Mj0iMTAwJSIgeTI9IjEwMCUiPgo8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjRkY2QjM1Ii8+CjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI0Y3OTMxRSIvPgo8L2xpbmVhckdyYWRpZW50Pgo8L2RlZnM+CjxwYXRoIGZpbGw9InVybCgjZ3JhZGllbnQpIiBkPSJNMCw0MDJMNTI2LDM2M0M1NzQsMzQ0LDU5OCwzNDIsNjI4LDMzM0M3MjIsMjk3LDgyNiwyNDMsOTI4LDIxNUM5ODQsMjAyLDEwMDcsMTk3LDEwNTQsMTg4QzExOTMsMTY1LDEzMzgsMTI5LDE0NDAsMTA4VjYwMEgwVjQwMloiLz4KPC9zdmc+')] bg-cover bg-center bg-no-repeat">
  <!-- Background gelombang -->
  <div></div>
  
  <!-- SVG Pattern overlay -->
  <div class="absolute inset-0 opacity-30">
    <svg class="w-full h-full" preserveAspectRatio="xMidYMid slice" viewBox="0 0 1440 800">
      <defs>
        <pattern id="wave-pattern" patternUnits="userSpaceOnUse" width="1440" height="320">
          <path d="M0,160 C360,100 720,220 1080,160 C1260,130 1350,100 1440,120 L1440,320 L0,320 Z" fill="rgba(255,255,255,0.1)"/>
          <path d="M0,200 C360,240 720,120 1080,180 C1260,150 1350,170 1440,140 L1440,320 L0,320 Z" fill="rgba(255,255,255,0.05)"/>
        </pattern>
      </defs>
      <rect width="100%" height="100%" fill="url(#wave-pattern)"/>
    </svg>
  </div>
  
  <!-- Konten di atas background -->
  <div class="relative z-10 container mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold text-white">Your Content</h1>
    <!-- konten lainnya -->
       <section class="bg-ivory min-h-screen flex items-center py-12 px-4">
        <div class="max-w-7xl mx-auto w-full">
            <!-- Header -->
            <div class="text-center mb-12">
                <p class="text-sm text-white/80 uppercase tracking-widest font-semibold mb-2">REAL PEOPLE, REAL STORIES</p>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Meet Our Neighbors</h1>
                <p class="text-white/90 max-w-2xl mx-auto text-lg">
                    Behind each number is a neighbor with strength and hope. See how—in kitchens, pantries, and homes—people unite to end hunger.
                </p>
            </div>

            <!-- Carousel Container -->
            <div class="relative">
                <!-- Main Content Area -->
                <div class="flex flex-col lg:flex-row items-center gap-8">
                    
                    <!-- Left Thumbnails (Hidden on mobile) -->
                    <div class="hidden lg:flex flex-col gap-4">
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white" onclick="carousel.goToSlide(0)">
                            <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=150&h=150&fit=crop&crop=faces" alt="Amal" class="w-full h-full object-cover">
                        </button>
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white" onclick="carousel.goToSlide(1)">
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=150&h=150&fit=crop&crop=faces" alt="Pendidikan" class="w-full h-full object-cover">
                        </button>
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white" onclick="carousel.goToSlide(2)">
                            <img src="https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=150&h=150&fit=crop&crop=faces" alt="Rumah Qur'an" class="w-full h-full object-cover">
                        </button>
                    </div>
                    
                    <!-- Main Card Area -->
                    <div class="flex-1 relative">
                        <!-- Main Image -->
                        <div class="relative bg-white rounded-2xl overflow-hidden shadow-2xl max-w-2xl mx-auto">
                            <div class="aspect-[4/3] relative">
                                <img id="mainImage" 
                                     src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&h=600&fit=crop&crop=faces" 
                                     alt="Main Program" 
                                     class="w-full h-full object-cover">
                                
                                <!-- Program Label -->
                                <div class="absolute bottom-4 left-4 bg-black/70 text-white px-3 py-1 rounded-lg text-sm font-medium">
                                    <span id="mainLabel">Program Amal</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Info Card -->
                        <div class="absolute -right-8 top-8 bg-yellow-300 p-6 rounded-xl shadow-lg max-w-sm z-10">
                            <h3 id="programTitle" class="text-xl font-bold text-gray-800 mb-2">Program Amal</h3>
                            <p id="programDescription" class="text-gray-700 text-sm leading-relaxed mb-4">
                                Program bantuan sosial untuk membantu masyarakat yang membutuhkan melalui berbagai kegiatan amal dan donasi.
                            </p>
                            {{-- <button class="text-orange-600 hover:text-orange-700 font-semibold text-sm inline-flex items-center">
                                Meet Program
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button> --}}
                        </div>
                    </div>
                    
                    <!-- Right Thumbnails -->
                    <div class="flex lg:flex-col flex-row gap-4 justify-center">
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white" onclick="carousel.goToSlide(3)">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=faces" alt="Majelis" class="w-full h-full object-cover">
                        </button>
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white" onclick="carousel.goToSlide(4)">
                            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=150&h=150&fit=crop&crop=faces" alt="Mu'alaf" class="w-full h-full object-cover">
                        </button>
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white" onclick="carousel.goToSlide(5)">
                            <img src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=150&h=150&fit=crop&crop=faces" alt="Sosial" class="w-full h-full object-cover">
                        </button>
                    </div>
                </div>
                
                <!-- Navigation Arrows -->
                <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 rounded-full p-3 transition-all duration-300 backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 rounded-full p-3 transition-all duration-300 backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>
  </div>
</section>
    <!-- Main Section -->
 

    <script>
        const programs = [
            {
                title: "Program Amal",
                description: "Program bantuan sosial untuk membantu masyarakat yang membutuhkan melalui berbagai kegiatan amal dan donasi.",
                image: "https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&h=600&fit=crop&crop=faces",
                thumbnail: "https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=150&h=150&fit=crop&crop=faces"
            },
            {
                title: "Program Pendidikan", 
                description: "Program peningkatan kualitas pendidikan melalui berbagai kegiatan pembelajaran dan pengembangan sumber daya manusia.",
                image: "https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&h=600&fit=crop&crop=faces",
                thumbnail: "https://images.unsplash.com/photo-1509062522246-3755977927d7?w=150&h=150&fit=crop&crop=faces"
            },
            {
                title: "Rumah Qur'an",
                description: "Program pembelajaran Al-Qur'an yang menyediakan tempat dan fasilitas untuk mempelajari kitab suci dengan baik dan benar.",
                image: "https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=800&h=600&fit=crop&crop=faces",
                thumbnail: "https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=150&h=150&fit=crop&crop=faces"
            },
            {
                title: "Program Majelis",
                description: "Program kegiatan majelis ilmu dan kajian keagamaan untuk meningkatkan pemahaman dan pengetahuan agama.",
                image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop&crop=faces",
                thumbnail: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=faces"
            },
            {
                title: "Program Mu'alaf",
                description: "Program pembinaan dan pendampingan bagi saudara-saudara mu'alaf dalam mengenal dan mempelajari ajaran Islam.",
                image: "https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800&h=600&fit=crop&crop=faces",
                thumbnail: "https://images.unsplash.com/photo-1521791136064-7986c2920216?w=150&h=150&fit=crop&crop=faces"
            },
            {
                title: "Program Sosial",
                description: "Program kegiatan sosial kemasyarakatan untuk membangun kebersamaan dan kepedulian dalam kehidupan bermasyarakat.",
                image: "https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800&h=600&fit=crop&crop=faces",
                thumbnail: "https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=150&h=150&fit=crop&crop=faces"
            }
        ];

        class NeighborCarousel {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = programs.length;
                this.mainImage = document.getElementById('mainImage');
                this.mainLabel = document.getElementById('mainLabel');
                this.programTitle = document.getElementById('programTitle');
                this.programDescription = document.getElementById('programDescription');
                this.thumbnails = document.querySelectorAll('.thumbnail');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                
                this.init();
            }
            
            init() {
                this.updateContent();
                this.updateThumbnails();
                
                // Event listeners
                this.prevBtn.addEventListener('click', () => this.prevSlide());
                this.nextBtn.addEventListener('click', () => this.nextSlide());
                
                // Auto-play
                this.startAutoPlay();
                
                // Touch support for mobile
                let startX = 0;
                let endX = 0;
                
                this.mainImage.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });
                
                this.mainImage.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    if (startX - endX > 50) {
                        this.nextSlide();
                    } else if (endX - startX > 50) {
                        this.prevSlide();
                    }
                });
            }
            
            updateContent() {
                const current = programs[this.currentSlide];
                this.mainImage.src = current.image;
                this.mainImage.alt = current.title;
                this.mainLabel.textContent = current.title;
                this.programTitle.textContent = current.title;
                this.programDescription.textContent = current.description;
                
                // Add smooth transition effect
                this.mainImage.style.opacity = '0';
                setTimeout(() => {
                    this.mainImage.style.opacity = '1';
                }, 150);
            }
            
            updateThumbnails() {
                this.thumbnails.forEach((thumb, index) => {
                    if (index === this.currentSlide) {
                        thumb.classList.remove('opacity-50');
                        thumb.classList.add('opacity-100', 'border-white');
                        thumb.classList.remove('border-transparent');
                    } else {
                        thumb.classList.add('opacity-50');
                        thumb.classList.remove('opacity-100', 'border-white');
                        thumb.classList.add('border-transparent');
                    }
                });
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                this.updateContent();
                this.updateThumbnails();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.updateContent();
                this.updateThumbnails();
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.updateContent();
                this.updateThumbnails();
            }
            
            startAutoPlay() {
                setInterval(() => {
                    this.nextSlide();
                }, 6000);
            }
        }
        
        // Initialize carousel
        let carousel;
        document.addEventListener('DOMContentLoaded', () => {
            carousel = new NeighborCarousel();
        });
    </script>
</body>
</html>