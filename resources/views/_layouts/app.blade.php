<!doctype html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GOING TO THE JAVA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- JS sudah termasuk admin.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
    @yield('head')
    @stack('styles')
    <style>
        .trix-content {
            font-size: 0.875rem;
            color: #1f2937;
            padding: 0.75rem;
        }

        .trix-button-group {
            @apply flex flex-wrap gap-1 p-2 bg-gray-50 border-b border-gray-200;
        }

        .trix-button {
            @apply px-2 py-1 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100;
        }

        .trix-button--active,
        .trix-button--on {
            @apply bg-blue-600 text-white border-blue-600;
        }

        .trix-dialogs {
            @apply bg-white border border-gray-300 rounded-lg p-4 shadow-lg;
        }
    </style>
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
    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="{{ asset('assets/js/drawer.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Tagify(document.querySelector('#tag'));
        });
    </script>

    @stack('scripts')
</body>

</html>