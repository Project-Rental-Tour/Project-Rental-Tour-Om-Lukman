<aside id="sidebar"
    class="fixed top-0 left-0 z-50 h-full w-64 -translate-x-full transform border-r border-gray-200 bg-white transition-transform duration-300 ease-in-out md:translate-x-0"
    aria-label="Sidebar">
    <div class="relative flex h-16 items-center justify-center border-b border-gray-200 px-4">
        <div class="flex items-center">
            <img 
                src="{{ optional($profiles)->website_logo_dark ? asset('storage/' . optional($profiles)->website_logo_dark) : asset('assets/images/logo/logo-dark.png') }}" 
                alt="Logo" 
                class="w-full h-7 mr-2"
            >
        </div>
        <button id="close-sidebar"
            class="p-2 text-gray-500 rounded-md md:hidden hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            aria-label="Close Sidebar">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Wrapper utama dengan flex column -->
    <div class="flex h-[calc(100%-4rem)] flex-col">
        <!-- Menu Navigation (akan mengisi ruang atas) -->
        <div class="flex-1 overflow-y-auto px-4 py-4">
            <nav class="space-y-1">
                <a href="{{ route('dashboard.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('dashboard.index') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.index') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('manage-user.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-user.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('manage-user.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Manage User
                </a>

                <a href="{{ route('manage-booking.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-booking.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('manage-booking.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Manage Booking
                </a>

                <a href="{{ route('manage-destination.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-destination.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('manage-destination.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Manage Destination
                </a>

                <a href="{{ route('manage-gallery.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-gallery.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('manage-gallery.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Manage Gallery
                </a>

                <a href="{{ route('manage-testimonials.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-testimonials.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('manage-testimonials.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                    Manage Testimoni
                </a>
            </nav>
        </div>

        <!-- Logout di bagian paling bawah -->
        <div class="border-t border-gray-200 px-4 py-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex w-full items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-red-100 hover:text-red-600 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>