{{-- x-show will display overlay if sidebarOpen is true and only on md screens and below --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 md:hidden"
    x-cloak></div>

<div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
    class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 transition-transform duration-300 ease-in-out transform border-r border-gray-200 bg-white md:relative md:translate-x-0 md:flex md:flex-shrink-0"
    x-cloak>

    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4l4 4m7-4h.01M12 12h.01M16 12h.01M3 20h18a2 2 0 002-2V6a2 2 0 00-2-2H3a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
            <span class="ml-2 text-xl font-bold text-gray-900">TourAdmin</span>
        </div>
        <button @click="sidebarOpen = false"
            class="p-2 text-gray-500 rounded-md md:hidden hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            aria-label="Close Sidebar">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
        <nav class="flex-1 space-y-1">
            {{-- Dashboard --}}
            <a href="{{ route('dashboard.index')}}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('dashboard.index') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
                aria-current="page">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('dashboard.index') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                Dashboard
            </a>

            {{-- User Management --}}
            <a href="{{ route('manage-user.index') }}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-user.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('manage-user.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                Manajemen User
            </a>

            {{-- Booking Management --}}
            <a href="{{ route('manage-booking.index')}}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-booking.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('manage-booking.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Manajemen Booking
            </a>

            {{-- Destination Management --}}
            <a href="{{ route('manage-destination.index') }}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-destination.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('manage-destination.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Manajemen Destination
            </a>

            {{-- Tour Management (Assuming route name will be 'manage-tour.*') --}}
            <a href="#" {{-- Replace with {{ route('manage-tour.index') }} later --}}
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-tour.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('manage-tour.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4">
                    </path>
                </svg>
                Manajemen Tours
            </a>

            {{-- Blog Management --}}
            <a href="{{ route('manage-blog.index')}}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-blog.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('manage-blog.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                    </path>
                </svg>
                Manajemen Blog
            </a>

            {{-- Gallery Management --}}
            <a href="{{ route('manage-gallery.index') }}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('manage-gallery.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('manage-gallery.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Manajemen Gallery
            </a>

            {{-- Testimonial Management --}}
            <a href="{{ route('testimoni.index')}}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-colors duration-200 {{ request()->routeIs('testimoni.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('testimoni.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                    </path>
                </svg>
                Manajemen Testimoni
            </a>

        </nav>
    </div>
</div>