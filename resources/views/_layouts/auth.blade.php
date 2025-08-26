<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SEPTEM TOUR')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('head')
    @stack('styles')
</head>

<body class="h-full font-sans antialiased bg-gray-50">
    @include('components.admin.toast')

    <!-- Konten penuh dikendalikan oleh child view -->
    @yield('content')

    @stack('scripts')
</body>

</html>