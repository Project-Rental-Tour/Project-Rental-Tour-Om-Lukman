<nav class=" fixed w-full z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse sm:ml-5">
            <img src="{{ asset('assets/images/logo/logo-white.png') }}" alt="" class="w-8 h-8">

        </a>

        <!-- Mobile menu button -->
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-white-100 "
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Navigation Links -->
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0">
                <li>
                    <a href="#" class="block py-2 px-3 text-white rounded md:bg-transparent md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-white rounded hover:bg-white-100 md:hover:bg-transparent md:hover:text-white-600 md:p-0">Destinations</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-white rounded hover:bg-white-100 md:hover:bg-transparent md:hover:text-white-600 md:p-0">Tours</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-white rounded hover:bg-white-100 md:hover:bg-transparent md:hover:text-white-600 md:p-0">About</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-white rounded hover:bg-white-100 md:hover:bg-transparent md:hover:text-white-600 md:p-0">Contact</a>
                </li>

            </ul>
        </div>
    </div>
</nav>