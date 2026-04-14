<!doctype html>
<html lang="en" class="h-full">

<head>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TGS6FD4F');</script>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; 
        script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com https://www.google-analytics.com https://www.googleadservices.com https://googleads.g.doubleclick.net; 
        script-src-elem 'self' 'unsafe-inline' https://www.googletagmanager.com https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com https://www.google-analytics.com https://www.googleadservices.com https://googleads.g.doubleclick.net;
        style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com; 
        img-src 'self' data: https://www.googletagmanager.com https://www.google-analytics.com https://stats.g.doubleclick.net https://www.google.com https://www.google.id https://googleads.g.doubleclick.net https://www.googleadservices.com https://images.unsplash.com https://*.unsplash.com {{ asset('') }}; 
        connect-src 'self' https://www.google-analytics.com https://stats.g.doubleclick.net https://www.google.com https://www.google.id https://googleads.g.doubleclick.net https://www.googleadservices.com https://region1.analytics.google.com; 
        font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; 
        frame-src 'self' https://www.googletagmanager.com https://www.google.com https://www.google.id;
        object-src 'none';">
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