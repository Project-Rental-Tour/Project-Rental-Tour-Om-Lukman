{{-- <nav data-navbar class="fixed w-full z-50 transition-all duration-300 bg-transparent">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-3 sm:ml-5">
            <!-- Logo Putih (untuk background gelap) -->
            <img id="logo-white"
                src="{{ optional($profiles)->website_logo_light ? asset('storage/' . optional($profiles)->website_logo_light) : asset('assets/images/logo/logo-white.png') }}"
                alt="Logo White" class="h-8 md:h-10 w-auto object-contain max-w-[160px] block">
            <!-- Logo Biru (untuk background terang) -->
            <img id="logo-dark"
                src="{{ optional($profiles)->website_logo_dark ? asset('storage/' . optional($profiles)->website_logo_dark) : asset('assets/images/logo/logo-blue.png') }}"
                alt="Logo Dark" class="h-8 md:h-10 w-auto object-contain max-w-[160px] hidden">
        </a>

        <!-- Mobile Menu Button -->
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Navigation Links -->
        <div class="hidden w-full md:block md:w-auto md:ml-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-6 md:mt-0">
                <li><a href="{{ route('index') }}"
                        class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Home</a></li>

                <li><a href="{{ route('destination.index') }}"
                        class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Tour Package</a></li>
                 <li><a href="{{ route('usercar.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Rent Car</a></li>
                <li><a href="{{ route('blogs.index') }}"
                        class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Blog</a></li>
               
                <li><a href="{{ route('gallery.index') }}"
                        class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Gallery</a></li>
                <li><a href="{{ route('about') }}"
                        class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">About Us</a></li>
            </ul>
        </div>
    </div>
</nav> --}}


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
            <span class="sr-only">@translate('Open main menu')</span>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto md:ml-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-6 md:mt-0 items-center">
                
                <li>
                    <a href="{{ route('index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors">
                        @translate('Home')
                    </a>
                </li>

                <li>
                    <a href="{{ route('destination.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors">
                        @translate('Tour Package')
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('usercar.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors">
                        @translate('Rent Car')
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('blogs.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors">
                        @translate('Blog')
                    </a>
                </li>
               
                <li>
                    <a href="{{ route('gallery.index') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors">
                        @translate('Gallery')
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('about') }}" class="block py-2 px-3 text-white rounded md:p-0 hover:text-secondary transition-colors">
                        @translate('About Us')
                    </a>
                </li>

                {{-- LANGUAGE SWITCHER (Dropdown) --}}
                <li class="relative group hidden md:block">
                    <button class="flex items-center gap-1 text-white hover:text-secondary py-2 px-3 font-bold uppercase text-xs border border-white/30 rounded-full hover:bg-white/10 transition-all">
                        <i class="fas fa-globe"></i> {{ session('app_locale', config('app.locale')) }}
                    </button>
                    
                    {{-- Dropdown Content --}}
                    <div class="absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-xl overflow-hidden hidden group-hover:block transition-all transform origin-top-right z-50">
                        <a href="{{ route('switch.language', 'id') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary flex items-center gap-2">
                            <img src="https://flagcdn.com/w20/id.png" class="w-4 rounded-sm"> ID (IDR)
                        </a>
                        <a href="{{ route('switch.language', 'en') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary flex items-center gap-2">
                            <img src="https://flagcdn.com/w20/us.png" class="w-4 rounded-sm"> EN (USD)
                        </a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- Script untuk efek Scroll Navbar (Transparan -> Putih) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('[data-navbar]');
        const logoWhite = document.getElementById('logo-white');
        const logoDark = document.getElementById('logo-dark');
        const navLinks = document.querySelectorAll('#navbar-default ul li a');
        const mobileButton = document.querySelector('[data-collapse-toggle]');
        const mobileIcon = mobileButton.querySelector('svg');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                // Saat di-scroll (Background Putih)
                navbar.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-md');
                navbar.classList.remove('bg-transparent');
                
                logoWhite.classList.add('hidden');
                logoWhite.classList.remove('block');
                logoDark.classList.add('block');
                logoDark.classList.remove('hidden');

                // Ubah warna text menu jadi gelap
                navLinks.forEach(link => {
                    link.classList.remove('text-white');
                    link.classList.add('text-primary');
                });
                
                // Ubah warna tombol mobile
                mobileButton.classList.remove('text-white');
                mobileButton.classList.add('text-primary');

            } else {
                // Saat di atas (Transparan)
                navbar.classList.remove('bg-white/90', 'backdrop-blur-md', 'shadow-md');
                navbar.classList.add('bg-transparent');

                logoWhite.classList.add('block');
                logoWhite.classList.remove('hidden');
                logoDark.classList.add('hidden');
                logoDark.classList.remove('block');

                // Ubah warna text menu jadi putih
                navLinks.forEach(link => {
                    link.classList.add('text-white');
                    link.classList.remove('text-primary');
                });

                // Ubah warna tombol mobile
                mobileButton.classList.add('text-white');
                mobileButton.classList.remove('text-primary');
            }
        });
    });
</script>