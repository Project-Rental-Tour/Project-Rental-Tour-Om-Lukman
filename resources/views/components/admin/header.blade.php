<header class="flex items-center justify-between h-16 px-6 border-b border-gray-200 bg-white shadow-sm w-full">
    <!-- Left section -->
    <div class="flex items-center space-x-3">
        <!-- Drawer toggle button for mobile -->
        <button type="button" data-drawer-target="sidebar-mobile"
            class="p-2 text-gray-500 rounded-md md:hidden hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1 class="text-xl font-semibold text-gray-900">@yield('pageTitle')</h1>
    </div>

    <!-- Right section -->
    <div class="flex items-center space-x-4 md:space-x-6">
        <!-- Search component -->
        <div x-data="{ showSearch: false }" class="flex items-center">
            <!-- Toggle button -->
            <button x-show="!showSearch" @click="showSearch = true"
                class="p-2 text-gray-500 rounded-full hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                aria-label="Search">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            <!-- Search bar - appears inline -->
            <div x-show="showSearch" x-transition class="relative">
                <div class="absolute right-8 top-2 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <input type="text" placeholder="Cari..."
                    class="w-48 md:w-64 pl-3 pr-12 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    @keydown.escape="showSearch = false">

                <!-- Close button on the far right -->
                <button @click="showSearch = false" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Date -->
        <div class="hidden md:block text-sm text-gray-500">
            {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('D, M d, Y') }}
        </div>

        <!-- Notification -->
        <button
            class="p-2 text-gray-500 rounded-full hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            aria-label="Notifications">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <!-- Profile -->
        <div class="relative" x-data="{ open: false }">
            {{-- <span class="hidden md:block text-gray-500 font-small">
                Hai, {{ Auth::user()->username }}
            </span> --}}
        </div>
    </div>
</header>