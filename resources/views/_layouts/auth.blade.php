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
    <div class="flex h-screen bg-gray-50">
        @yield('content')
    </div>
    @stack('scripts')
</body>

</html>