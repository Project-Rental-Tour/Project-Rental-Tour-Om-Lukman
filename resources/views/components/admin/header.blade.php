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
            class="p-2 text-gray-500 rounded-full hover:bg-gray-100">
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
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="p-2 text-gray-600 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition relative group">
                <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <!-- Red Dot Indicator -->
                @if($notifications->where('is_read', false)->count() > 0)
                    <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                @endif
            </button>

            <!-- Dropdown -->
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" @click.outside="open = false" x-cloak
                class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-xl shadow-xl z-50 max-h-96 overflow-hidden font-sans">

                <!-- Header -->
                <div class="px-4 py-3 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-blue-50">
                    <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Notifikasi Booking
                    </h3>
                </div>

                <!-- List -->
                <div class="overflow-y-auto max-h-80 divide-y divide-gray-100">
                    @if($notifications->isEmpty())
                        <div class="p-6 text-center text-gray-500 text-sm">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p>Tidak ada notifikasi</p>
                        </div>
                    @else
                        <ul>
                            @foreach($notifications as $log)
                                <li
                                    class="px-4 py-3 hover:bg-indigo-50 transition cursor-pointer border-l-2 border-transparent hover:border-indigo-300">
                                    <p class="text-sm text-gray-800 leading-tight line-clamp-2">
                                        {{ $log->description }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $log->created_at->diffForHumans() }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Footer -->
                <div class="px-3 py-2 bg-gray-50 border-t border-gray-100 text-right">
                    <a href="{{ route('manage-booking.index') }}"
                        class="text-xs font-medium text-indigo-600 hover:text-indigo-800 hover:underline transition">
                        Lihat Semua Riwayat
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                <span>Hai, {{ Auth::user()->username ?? 'Admin' }}</span>
            </button>

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

            <input type="text" name="search" placeholder="Search" x-ref="searchInput"
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