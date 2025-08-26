<header x-data="{ showSearch: false }" @click.outside="showSearch = false"
    class="flex items-center justify-between h-16 border-b border-gray-200 bg-white px-6 shadow-sm relative">

    <!-- Left: Hamburger & Title -->
    <div class="flex items-center space-x-3">
        <button id="drawer-toggle" type="button"
            class="p-2 text-gray-500 rounded-md md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <h1 class="text-xl font-semibold text-gray-900 z-10">
            <span x-show="!showSearch" x-cloak style="display: none;">@yield('pageTitle', 'Dashboard')</span>
        </h1>
    </div>

    <!-- Right: Normal Elements (hidden saat search aktif) -->
    <div x-show="!showSearch" x-cloak style="display: none;" class="flex items-center space-x-4 md:space-x-6">

        <!-- Dynamic Search Button -->
        <button @click="showSearch = true; $nextTick(() => $refs.searchInput.focus())"
            class="p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>

        <!-- Date -->
        <div class="hidden md:block text-sm text-gray-500 whitespace-nowrap">
            {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('D, M d, Y') }}
        </div>

        <!-- Notification -->
        <button
            class="p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <!-- Profile -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                <span>Hai, {{ Auth::user()->username ?? 'Admin' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Full-Width Search Bar -->
    <div x-show="showSearch" x-cloak style="display: none;"
        class="absolute inset-0 flex items-center px-6 bg-white border-b border-gray-200 z-20 shadow-sm">
        <form method="GET" :action="window.location.pathname"
            class="flex items-center bg-gray-100 rounded-lg border border-gray-300 w-full max-w-3xl mx-auto overflow-hidden">

            <div class="pl-3 text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <input type="text" name="search" placeholder="Cari di halaman ini..." x-ref="searchInput"
                :value="new URLSearchParams(window.location.search).get('search') || ''"
                class="w-full px-3 py-2 bg-gray-100 text-sm focus:outline-none" autofocus />

            <button type="button" @click="showSearch = false" class="p-2 text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <button type="submit" class="hidden">Submit</button>
        </form>
    </div>
</header>