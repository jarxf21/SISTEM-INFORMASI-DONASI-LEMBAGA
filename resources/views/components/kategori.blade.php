
<section>
    @php
    $programs = $programs ?? [];
@endphp
    @php
    $kategori = $kategori ?? collect();
    $leftThumbs = $kategori->slice(0, 3);
    // pilih mainImage: item ke-3 (index 3) jika ada, kalau nggak pakai first()
    $mainImage = $kategori->get(3) ?? $kategori->first();
    $rightThumbs = $kategori->slice(3, 3);
@endphp

<div class="bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQ0MCIgaGVpZ2h0PSI2MDAiIHZpZXdCb3g9IjAgMCAxNDQwIDYwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGRlZnM+CjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZGllbnQiIHgxPSIwJSIgeTE9IjAlIiB4Mj0iMTAwJSIgeTI9IjEwMCUiPgo8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjRkY2QjM1Ii8+CjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI0Y3OTMxRSIvPgo8L2xpbmVhckdyYWRpZW50Pgo8L2RlZnM+CjxwYXRoIGZpbGw9InVybCgjZ3JhZGllbnQpIiBkPSJNMCw0MDJMNTI2LDM2M0M1NzQsMzQ0LDU5OCwzNDIsNjI4LDMzM0M3MjIsMjk3LDgyNiwyNDMsOTI4LDIxNUM5ODQsMjAyLDEwMDcsMTk3LDEwNTQsMTg4QzExOTMsMTY1LDEzMzgsMTI5LDE0NDAsMTA4VjYwMEgwVjQwMloiLz4KPC9zdmc+')] bg-cover bg-center bg-no-repeat py-8">
    <div class="max-w-7xl mx-auto w-full px-4">
        <!-- Header -->
        <div class="text-center mb-8 lg:mb-12">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4 lg:mb-6">Program Kami</h1>
            <p class="text-black/90 max-w-2xl mx-auto text-base lg:text-lg px-4">
                 Berbagai program yang kami jalankan untuk memberikan manfaat bagi masyarakat
            </p>
        </div>

        <!-- Carousel Container -->
        <div class="relative">
            <!-- Main Content Area -->
            <div class="flex flex-col lg:flex-row items-center gap-4 lg:gap-8">
                
                <!-- Left Thumbnails (Desktop Only) -->
                <div class="hidden lg:flex flex-col gap-4">
                    @foreach($leftThumbs as $i => $kat)
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white" onclick="carousel.goToSlide({{ $i }})">
                            <img src="{{ $kat->gambar_kategori ? asset('storage/'.$kat->gambar_kategori) : asset('images/default-kategori.jpg') }}" alt="{{ $kat->nama_kategori }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
                
                <!-- Main Card Area -->
                <div class="flex-1 relative w-full">
                    <!-- Main Image -->
                    <div class="relative bg-white rounded-2xl overflow-hidden shadow-2xl mx-auto max-w-sm sm:max-w-md lg:max-w-2xl">
                        <div class="aspect-[4/3] relative">
                            @if($mainImage)
                                <img id="mainImage" 
                                     src="{{ $mainImage->gambar_kategori ? asset('storage/'.$mainImage->gambar_kategori) : asset('images/default-kategori.jpg') }}" 
                                     alt="{{ $mainImage->nama_kategori }}" 
                                     class="w-full h-full object-cover transition-opacity duration-300">
                                
                                <!-- Program Label -->
                                <div class="absolute bottom-4 left-4 bg-black/70 text-white px-3 py-1 rounded-lg text-sm font-medium">
                                    <span id="mainLabel">{{ $mainImage->nama_kategori }}</span>
                                </div>
                            @endif
                            
                            <!-- Mobile Navigation Dots -->
                            <div class="lg:hidden absolute bottom-4 right-4 flex gap-1">
                                @for($i = 0; $i < $kategori->count(); $i++)
                                    <div class="dot w-2 h-2 rounded-full bg-white/50" data-slide="{{ $i }}"></div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Card - Responsive positioning -->
                    <div class="relative lg:absolute lg:-right-8 lg:top-8 bg-orange-200 p-4 lg:p-6 rounded-xl shadow-lg max-w-full lg:max-w-sm z-10 mt-4 lg:mt-0 mx-4 lg:mx-0">
                        @if($mainImage)
                            <h3 id="programTitle" class="text-lg lg:text-xl font-bold text-gray-800 mb-2">{{ $mainImage->nama_kategori }}</h3>
                            <p id="programDescription" class="text-gray-700 text-sm leading-relaxed mb-4">
                                {{ $mainImage->deskripsi ?? 'Program bantuan sosial untuk membantu masyarakat yang membutuhkan melalui berbagai kegiatan amal dan donasi.' }}
                            </p>
                        @endif
                    </div>
                </div>
                
                <!-- Right Thumbnails (Desktop) / Bottom Thumbnails (Mobile) -->
                <div class="flex lg:flex-col flex-row gap-3 lg:gap-4 justify-center mt-4 lg:mt-0 px-4 lg:px-0 overflow-x-auto lg:overflow-visible w-full lg:w-auto">
                    @foreach($rightThumbs as $j => $kat)
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-16 h-16 lg:w-20 lg:h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-white flex-shrink-0" onclick="carousel.goToSlide({{ $j }})">
                            <img src="{{ $kat->gambar_kategori ? asset('storage/'.$kat->gambar_kategori) : asset('images/default-kategori.jpg') }}" alt="{{ $kat->nama_kategori }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                    
                    <!-- Mobile-only left thumbnails -->
                    @foreach($leftThumbs as $i => $kat)
                        <button class="thumbnail opacity-50 hover:opacity-100 transition-opacity duration-300 w-16 h-16 rounded-lg overflow-hidden border-2 border-transparent hover:border-white flex-shrink-0 lg:hidden" onclick="carousel.goToSlide({{ $i }})">
                            <img src="{{ $kat->gambar_kategori ? asset('storage/'.$kat->gambar_kategori) : asset('images/default-kategori.jpg') }}" alt="{{ $kat->nama_kategori }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            </div>
            
            <!-- Navigation Arrows - Hidden on mobile -->
            <button id="prevBtn" class="hidden lg:block absolute left-20 top-1/2 -translate-y-1/2 bg-orange-400 hover:bg-tombol rounded-full p-3 transition-all duration-300">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button id="nextBtn" class="hidden lg:block absolute right-20 top-1/2 -translate-y-1/2 bg-orange-400 hover:bg-tombol rounded-full p-3 transition-all duration-300">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Mobile Swipe Navigation Arrows -->
            <button id="mobilePrevBtn" class="lg:hidden absolute left-2 top-1/2 -translate-y-1/2 bg-orange-400/80 hover:bg-orange-500 rounded-full p-2 transition-all duration-300 z-20">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button id="mobileNextBtn" class="lg:hidden absolute right-2 top-1/2 -translate-y-1/2 bg-orange-400/80 hover:bg-orange-500 rounded-full p-2 transition-all duration-300 z-20">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ff8800" fill-opacity="1" d="M0,320L80,272C160,224,320,128,480,101.3C640,75,800,117,960,112C1120,107,1280,53,1360,26.7L1440,0L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path></svg>
        </div>
        </section>
<script>

   const programs = @json($programs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        class NeighborCarousel {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = programs.length;
                this.mainImage = document.getElementById('mainImage');
                this.mainLabel = document.getElementById('mainLabel');
                this.programTitle = document.getElementById('programTitle');
                this.programDescription = document.getElementById('programDescription');
                this.thumbnails = document.querySelectorAll('.thumbnail');
                this.dots = document.querySelectorAll('.dot');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                this.mobilePrevBtn = document.getElementById('mobilePrevBtn');
                this.mobileNextBtn = document.getElementById('mobileNextBtn');
                
                this.init();
            }
            
            init() {
                this.updateContent();
                this.updateThumbnails();
                this.updateDots();
                
                // Event listeners for desktop arrows
                this.prevBtn?.addEventListener('click', () => this.prevSlide());
                this.nextBtn?.addEventListener('click', () => this.nextSlide());
                
                // Event listeners for mobile arrows
                this.mobilePrevBtn?.addEventListener('click', () => this.prevSlide());
                this.mobileNextBtn?.addEventListener('click', () => this.nextSlide());
                
                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });
                
                // Auto-play (longer interval for mobile)
                this.startAutoPlay();
                
                // Enhanced touch support for mobile
                this.setupTouchNavigation();
            }
            
            setupTouchNavigation() {
                let startX = 0;
                let startY = 0;
                let endX = 0;
                let endY = 0;
                let startTime = 0;
                
                this.mainImage.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                    startTime = Date.now();
                }, { passive: true });
                
                this.mainImage.addEventListener('touchmove', (e) => {
                    // Prevent default scrolling behavior for horizontal swipes
                    const currentX = e.touches[0].clientX;
                    const currentY = e.touches[0].clientY;
                    const diffX = Math.abs(currentX - startX);
                    const diffY = Math.abs(currentY - startY);
                    
                    if (diffX > diffY && diffX > 20) {
                        e.preventDefault();
                    }
                }, { passive: false });
                
                this.mainImage.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    endY = e.changedTouches[0].clientY;
                    const endTime = Date.now();
                    
                    const diffX = startX - endX;
                    const diffY = Math.abs(startY - endY);
                    const timeDiff = endTime - startTime;
                    
                    // Only trigger swipe if it's primarily horizontal and fast enough
                    if (Math.abs(diffX) > 50 && diffY < 100 && timeDiff < 500) {
                        if (diffX > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                }, { passive: true });
            }
            
            updateContent() {
                const current = programs[this.currentSlide];
                
                // Add fade transition
                this.mainImage.style.opacity = '0';
                
                setTimeout(() => {
                    this.mainImage.src = current.image;
                    this.mainImage.alt = current.title;
                    this.mainLabel.textContent = current.title;
                    this.programTitle.textContent = current.title;
                    this.programDescription.textContent = current.description;
                    this.mainImage.style.opacity = '1';
                }, 150);
            }
            
            updateThumbnails() {
                this.thumbnails.forEach((thumb, index) => {
                    const slideIndex = parseInt(thumb.getAttribute('onclick')?.match(/\d+/)?.[0] || '0');
                    if (slideIndex === this.currentSlide) {
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
            
            updateDots() {
                this.dots.forEach((dot, index) => {
                    if (index === this.currentSlide) {
                        dot.classList.remove('bg-white/50');
                        dot.classList.add('bg-white');
                    } else {
                        dot.classList.add('bg-white/50');
                        dot.classList.remove('bg-white');
                    }
                });
            }
            
            goToSlide(slideIndex) {
                this.currentSlide = slideIndex;
                this.updateContent();
                this.updateThumbnails();
                this.updateDots();
            }
            
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.updateContent();
                this.updateThumbnails();
                this.updateDots();
            }
            
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.updateContent();
                this.updateThumbnails();
                this.updateDots();
            }
            
            startAutoPlay() {
                // Longer interval for better mobile experience
                setInterval(() => {
                    this.nextSlide();
                }, 8000);
            }
        }
        
        // Initialize carousel
        let carousel;
        document.addEventListener('DOMContentLoaded', () => {
            carousel = new NeighborCarousel();
        });
</script>

