<!doctype html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <!-- Meta tags dan CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SEPTEM TOUR')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('head')
    @stack('styles')
</head>

<body class="h-full font-sans antialiased">
    @include('components.admin.toast')
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar (seperti di atas) -->
        <div class="hidden md:flex md:flex-shrink-0">
            @include('components.admin.sidebar')
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between h-16 border-b border-gray-200 bg-white">
                @include('components.admin.header')
            </header>

            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto p-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const closeSidebarBtn = document.getElementById('close-sidebar');

            // Function untuk membuka sidebar
            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            // Function untuk menutup sidebar
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Event listener untuk tombol hamburger di header
            document.querySelector('[data-drawer-target="sidebar-mobile"]').addEventListener('click', openSidebar);

            // Event listener untuk tombol close di sidebar
            closeSidebarBtn.addEventListener('click', closeSidebar);

            // Event listener untuk overlay
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Event listener untuk escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeSidebar();
                }
            });

            // Auto close sidebar ketika link di klik (untuk mobile)
            document.querySelectorAll('#sidebar nav a').forEach(link => {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 768) {
                        closeSidebar();
                    }
                });
            });
        });
    </script>
</body>

</html>