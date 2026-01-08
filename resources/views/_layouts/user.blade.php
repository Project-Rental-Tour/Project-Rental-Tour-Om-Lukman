<!doctype html>
<html lang="id" class="scroll-smooth">

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TGS6FD4F');</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Primary Meta Tags -->
    <title>@yield('title', 'GOING TO THE JAVA – Paket Wisata & Sewa Mobil di Jawa Timur, Indonesia')</title>
    <meta name="description" content="@yield('meta-description', 'GOING TO THE JAVA adalah agen travel lokal di Malang, Jawa Timur, Indonesia. Kami menyediakan paket wisata Bromo sunrise, tour Ijen Blue Fire, Tumpak Sewu, sewa mobil Malang & Surabaya, dengan supir profesional dan harga transparan.')">
    <meta name="keywords" content="wisata Jawa Timur, paket Bromo Indonesia, sewa mobil Malang, tour Ijen Blue Fire, travel Tumpak Sewu, sewa Hiace Surabaya, jeep Bromo sunrise, Malang city tour, Surabaya car rental, east java tour, paket honeymoon Bromo, going to the java indonesia">
    <meta name="author" content="GOING TO THE JAVA">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="@yield('canonical', 'https://www.goingtothejava.com')" />

    <!-- Open Graph / Facebook -->
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('og-title', 'GOING TO THE JAVA – Travel & Sewa Mobil di Jawa Timur, Indonesia')" />
    <meta property="og:description" content="@yield('og-description', 'Jelajahi Gunung Bromo, Kawah Ijen, Tumpak Sewu & kota Malang-Surabaya bersama agen travel lokal terpercaya di Jawa Timur, Indonesia.')" />
    <meta property="og:url" content="@yield('og-url', 'https://www.goingtothejava.com')" />
    <meta property="og:site_name" content="GOING TO THE JAVA" />
    <meta property="og:image" content="@yield('og-image', asset('assets/images/og-bromo-jeep.jpg'))" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:alt" content="@yield('og-image-alt', 'Jeep Bromo Sunrise di Gunung Bromo, Jawa Timur, Indonesia – oleh GOING TO THE JAVA')" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('twitter-title', 'GOING TO THE JAVA – Wisata Bromo, Ijen & Tumpak Sewu | Jawa Timur')" />
    <meta name="twitter:description" content="@yield('twitter-description', 'Paket wisata otentik ke destinasi ikonik Jawa Timur, Indonesia. Armada baru, pemandu lokal, harga terjangkau.')" />
    <meta name="twitter:image" content="@yield('twitter-image', asset('assets/images/og-bromo-jeep.jpg'))" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome (local) -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Custom Styles -->
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
        .bg-primary { background-color: #799eff; }
        .text-primary { color: #799eff; }
        .text-white { color: #ffffff; }
        .text-green { color: #10b981; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <!-- Structured Data (Schema.org) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TravelAgency",
        "name": "GOING TO THE JAVA",
        "description": "Agen travel lokal di Malang, Jawa Timur, Indonesia yang menyediakan paket wisata Gunung Bromo, Kawah Ijen, Air Terjun Tumpak Sewu, dan sewa mobil di Malang & Surabaya.",
        "url": "https://www.goingtothejava.com",
        {{-- "logo": "{{ asset('assets/images/logo.png') }}",
        "image": "{{ asset('assets/images/og-bromo-jeep.jpg') }}", --}}
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Malang",
            "addressRegion": "Jawa Timur",
            "addressCountry": "ID"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": -7.9666,
            "longitude": 112.6326
        },
        "telephone": "+628123456789",
        "areaServed": "ID",
        "serviceType": "Tourism and Travel Services in East Java, Indonesia",
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
            "opens": "08:00",
            "closes": "22:00"
        },
        "priceRange": "Rp1.100.000 – Rp10.000.000",
        "sameAs": [
            "https://www.instagram.com/goingtothejava",
            "https://www.facebook.com/goingtothejava"
        ],
        "offers": {
            "@type": "AggregateOffer",
            "lowPrice": 1100000,
            "highPrice": 10000000,
            "priceCurrency": "IDR"
        }
    }
    </script>

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

<body class="bg-gray-50 font-sans antialiased">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGS6FD4F"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Toast Notifications -->
    @include('components.admin.toast')

    <!-- Main Content -->
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Custom JS -->
    @if (file_exists(public_path('assets/js/navbar.js')))
        <script src="{{ asset('assets/js/navbar.js') }}"></script>
    @endif
    @if (file_exists(public_path('assets/js/stats.js')))
        <script src="{{ asset('assets/js/stats.js') }}"></script>
    @endif
    @if (file_exists(public_path('assets/js/whatsAppIcon.js')))
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fade-in animation on scroll
            const animatedElements = document.querySelectorAll('.animate-fade-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            animatedElements.forEach(el => observer.observe(el));

            // Swiper (Testimonials)
            if (typeof Swiper !== 'undefined' && document.querySelector('.testimonial-swiper')) {
                new Swiper('.testimonial-swiper', {
                    loop: true,
                    spaceBetween: 30,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        640: { slidesPerView: 1 },
                        768: { slidesPerView: 2 },
                        1024: { slidesPerView: 3 }
                    }
                });
            }

            // Smooth scroll
            if (typeof SmoothScroll !== 'undefined') {
                new SmoothScroll('a[href*="#"]', {
                    speed: 800,
                    speedAsDuration: true
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>