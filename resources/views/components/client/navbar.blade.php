<nav data-navbar class="fixed w-full z-50 transition-all duration-300 bg-transparent">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 sm:ml-5">
            <img id="logo-white"
                src="{{ optional($profiles)->website_logo_light ? asset('storage/' . optional($profiles)->website_logo_light) : asset('assets/images/logo/logo-white.png') }}"
                alt="Logo White" class="h-8 md:h-10 w-auto object-contain max-w-[160px] block">
            
            <img id="logo-dark"
                src="{{ optional($profiles)->website_logo_dark ? asset('storage/' . optional($profiles)->website_logo_dark) : asset('assets/images/logo/logo-blue.png') }}"
                alt="Logo Dark" class="h-8 md:h-10 w-auto object-contain max-w-[160px] hidden">
        </a>

        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200 text-white"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">@translate('Buka menu utama')</span>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto md:ml-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-6 md:mt-0 items-center">
                
                <li>
                    <a href="{{ route('index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors capitalize">
                        @translate('Beranda')
                    </a>
                </li>

                <li>
                    <a href="{{ route('destination.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors capitalize">
                        @translate('Paket Wisata')
                    </a>
                </li>
                
                {{-- <li>
                    <a href="{{ route('usercar.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors capitalize">
                        @translate('Sewa Mobil')
                    </a>
                </li> --}}
                
                <li>
                    <a href="{{ route('blogs.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors capitalize ">
                        @translate('Blog')
                    </a>
                </li>
               
                <li>
                    <a href="{{ route('gallery.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors capitalize">
                        @translate('Galeri')
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('about') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors capitalize">
                        @translate('Tentang Kami')
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- Script Logic Scroll 80% Jumbotron --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('[data-navbar]');
        const logoWhite = document.getElementById('logo-white');
        const logoDark = document.getElementById('logo-dark');
        const navLinks = document.querySelectorAll('#navbar-default ul li a');
        const mobileButton = document.querySelector('[data-collapse-toggle]');
        
        // Fungsi Update Navbar
        function updateNavbar() {
            // Ambil elemen Jumbotron
            const jumbotron = document.getElementById('jumbotron');
            let triggerHeight = 50; // Default jika tidak ada jumbotron (halaman lain)

            // Jika ada Jumbotron, hitung 80% dari tingginya
            if (jumbotron) {
                triggerHeight = jumbotron.offsetHeight * 0.8;
            }

            // Cek posisi scroll
            if (window.scrollY > triggerHeight) {
                // --- STATE: SCROLLED (Lewat 80% Jumbotron) ---
                // Background Putih
                navbar.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-md');
                navbar.classList.remove('bg-transparent');
                
                // Ganti Logo
                logoWhite.classList.add('hidden');
                logoWhite.classList.remove('block');
                logoDark.classList.add('block');
                logoDark.classList.remove('hidden');

                // Ganti Warna Teks Menu jadi Gelap (Primary)
                navLinks.forEach(link => {
                    link.classList.remove('text-white');
                    link.classList.add('text-primary');
                });
                
                // Ganti Warna Tombol Mobile
                mobileButton.classList.remove('text-white');
                mobileButton.classList.add('text-primary');

            } else {
                // --- STATE: TOP (Di atas Jumbotron) ---
                // Background Transparan
                navbar.classList.remove('bg-white/90', 'backdrop-blur-md', 'shadow-md');
                navbar.classList.add('bg-transparent');

                // Ganti Logo
                logoWhite.classList.add('block');
                logoWhite.classList.remove('hidden');
                logoDark.classList.add('hidden');
                logoDark.classList.remove('block');

                // Ganti Warna Teks Menu jadi Putih
                navLinks.forEach(link => {
                    link.classList.add('text-white');
                    link.classList.remove('text-primary');
                });

                // Ganti Warna Tombol Mobile
                mobileButton.classList.add('text-white');
                mobileButton.classList.remove('text-primary');
            }
        }

        // Jalankan saat di-scroll
        window.addEventListener('scroll', updateNavbar);
        
        // Jalankan sekali saat load (jika di-refresh saat posisi di tengah bawah)
        updateNavbar();
    });
</script>