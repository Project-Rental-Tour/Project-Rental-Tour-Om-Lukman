<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'SEPTEM TOUR')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        .animate-fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .animate-fade-up.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2563eb;
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .quote-icon {
            position: absolute;
            top: -1rem;
            left: -1rem;
            width: 3rem;
            height: 3rem;
            background-color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            color: white;
        }
    </style>
    @yield('head')
    @stack('styles')
</head>

<body>
    @yield('content')
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="{{ asset('assets/js/navbar.js') }}"></script>
    <script src="{{ asset('assets/js/stats.js') }}"></script>
    @stack('scripts')
</body>

</html>