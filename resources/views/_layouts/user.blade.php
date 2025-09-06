<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Affordable car rental & complete tour packages with Septem Tour. New fleet, competitive prices, and professional service for your East Java adventure.">
    <meta name="keywords" content="car rental indonesia, rent a car bromo, bromo tour package, cheap bromo tour, malang car rental, surabaya car hire, tumpak sewu waterfall, ijen crater blue fire, east java travel, family vacation indonesia, honeymoon package bromo, budget tour east java, mount bromo jeep tour, ijen volcano tour, malang city tour, beach tourism, mountain tourism, cultural heritage tour, historical sites, culinary tour, septem tour">
    <meta name="author" content="Septem Tour">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Septem Tour - Trusted Car Rental & Tour Packages in East Java">
    <meta property="og:description" content="Explore Bromo, Ijen, Tumpak Sewu & more with affordable car rentals and curated tour packages. New vehicles, local guides, 24/7 support. Book your adventure now!">
    <meta property="og:url" content="https://www.septemtour.com">
    <meta property="og:type" content="website">
    <meta property="og:image:alt" content="Septem Tour Bromo Jeep Adventure at Sunrise">
    <meta property="og:locale" content="en_US">

    <title>@yield('title', 'SEPTEM TOUR')</title>
    
    <!-- Load Vite resources -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.css" rel="stylesheet" />
    
    <!-- Additional Head Content -->
    @yield('head')
    
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
        
        /* Additional styles for your content */
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
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": ["TravelAgency", "TouristAttraction"],
        "name": "Septem Tour",
        "description": "Penyedia layanan sewa mobil dan paket wisata ke destinasi populer di Jawa Timur seperti Gunung Bromo, Gunung Semeru, dan Air Terjun Tumpak Sewu.",
        "url": "https://www.septemtour.com",,
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
        "openingHours": "Mo-Su 08:00-22:00",
        "priceRange": "IDR 3650000 - IDR 10000000"
        "sameAs": [
            "https://www.instagram.com/septemtour",
            "https://www.facebook.com/septemtour"
        ]
    }
    </script>
    
    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Toast Notifications -->
    @include('components.admin.toast')
    
    <!-- Main Content -->
    @yield('content')
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
    
    <!-- Custom Scripts -->
    <script src="{{ asset('assets/js/navbar.js') }}"></script>
    <script src="{{ asset('assets/js/stats.js') }}"></script>
    <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    
    <script>
        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on scroll
            const animatedElements = document.querySelectorAll('.animate-fade-up');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            
            animatedElements.forEach(el => observer.observe(el));
            
            // Initialize Swiper if exists
            if (typeof Swiper !== 'undefined') {
                const testimonialSwiper = new Swiper('.testimonial-swiper', {
                    loop: true,
                    spaceBetween: 30,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 2,
                        },
                        1024: {
                            slidesPerView: 3,
                        },
                    },
                });
            }
            
            // Initialize smooth scroll
            const scroll = new SmoothScroll('a[href*="#"]', {
                speed: 800,
                speedAsDuration: true
            });
        });
    </script>
    
    
    @stack('scripts')
</body>
</html>