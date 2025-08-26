<!doctype html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SEPTEM TOUR')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- JS sudah termasuk admin.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('head')
    @stack('styles')
</head>

<body class="h-full font-sans antialiased">
    @include('components.admin.toast')

    <!-- Overlay untuk sidebar mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-gray-600 bg-opacity-75 md:hidden" aria-hidden="true">
    </div>

    <!-- Sidebar -->
    @include('components.admin.sidebar')

    <!-- Main Content -->
    <div class="flex flex-col md:ml-64 min-h-screen">
        @include('components.admin.header')
        <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Alpine.js & Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="{{ asset('assets/js/drawer.js') }}"></script>

    @stack('scripts')
</body>

</html>