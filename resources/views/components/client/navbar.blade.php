<nav data-navbar class="fixed w-full z-50 transition-all duration-300 bg-transparent">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-3 sm:ml-5">
            <img id="logo-white" src="{{ optional($profiles)->website_logo_light ? asset('storage/'. optional($profiles)->website_logo_light) : asset('assets/images/logo/logo-white.png') }}" alt="Logo White"
                class="w-8 h-8 block">
            <img id="logo-dark" src="{{ optional($profiles)->website_logo_dark ? asset('storage/' . optional($profiles)->website_logo_dark) : asset('assets/images/logo/logo-blue.png') }}" alt="Logo Dark"
                class="w-8 h-8 hidden">
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
                <li><a href="#about" class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">About</a>
                <li><a href="#destination"
                        class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Destination</a></li>
                <li><a href="#blog" class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Blog</a></li>
                </li>
                <li><a href="#booking-process"
                        class="block py-2 px-3 text-white rounded md:p-0 hover:text-gray-300">Booking Guide</a></li>
            </ul>
        </div>
    </div>
</nav>