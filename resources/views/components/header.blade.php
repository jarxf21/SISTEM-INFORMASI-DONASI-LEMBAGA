<nav class="sticky top-0 left-0 right-0 z-50 bg-navbar shadow-lg ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2 text-white font-bold text-xl hover:scale-105 transition-transform duration-300">
                        {{-- <span class="text-2xl">🤝</span> --}}
                        <span>Sahabat Ummat</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/beranda" class="text-white px-4 py-2 rounded-full font-medium hover:bg-tombol hover:bg-opacity-20  hover:shadow-lg">
                        Beranda
                    </a>
                     <a href="/campaign" class="text-white px-4 py-2 rounded-full font-medium hover:bg-tombol hover:bg-opacity-20 hover:shadow-lg">
                        Campaign
                    </a>
                    <a href="/donasi" class="text-white px-4 py-2 rounded-full font-medium hover:bg-tombol hover:bg-opacity-20 hover:shadow-lg">
                        Informasi Donasi
                    </a>
                    <a href="/kegiatan" class="text-white px-4 py-2 rounded-full font-medium hover:bg-tombol hover:bg-opacity-20 hover:shadow-lg">
                        Kegiatan
                    </a>
                    <a href="/kontak" class="text-white px-4 py-2 rounded-full font-medium hover:bg-tombol hover:bg-opacity-20 hover:shadow-lg">
                        Kontak
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-white hover:text-accent focus:outline-none focus:text-accent transition-colors duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-primary bg-opacity-95 backdrop-blur-md">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="/beranda" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                    <span class="flex items-center space-x-2">
                        
                        <span>Beranda</span>
                    </span>
                </a>
                <a href="/campaign" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                    <span class="flex items-center space-x-2">
                        
                        <span>Campaign</span>
                    </span>
                </a>
                <a href="/donasi" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                    <span class="flex items-center space-x-2">
                        
                        <span>Informasi Donasi</span>
                    </span>
                </a>
                <a href="/kegiatan" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                    <span class="flex items-center space-x-2">
                       
                        <span>Kegiatan</span>
                    </span>
                </a>
                <a href="/kontak" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                    <span class="flex items-center space-x-2">
                       
                        <span>Kontak</span>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Demo Content -->
   

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            
            // Toggle hamburger icon
            const icon = mobileMenuBtn.querySelector('svg');
            if (mobileMenu.classList.contains('hidden')) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
            }
        });

        // Close mobile menu when clicking on a link
        const mobileLinks = document.querySelectorAll('#mobile-menu a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                const icon = mobileMenuBtn.querySelector('svg');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
            });
        });
    </script>