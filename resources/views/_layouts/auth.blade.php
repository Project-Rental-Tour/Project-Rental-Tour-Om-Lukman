<!doctype html>
<html lang="en" class="h-full">

<head>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TGS6FD4F');</script>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GOING TO THE JAVA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    @yield('head')
    @stack('styles')
    </script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-17775817511');
    </script>
</head>

<body class="h-full font-sans antialiased bg-gray-50">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGS6FD4F"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @include('components.admin.toast')

    @yield('content')

    @stack('scripts')
</body>

</html>