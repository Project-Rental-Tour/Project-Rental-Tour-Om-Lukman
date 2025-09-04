<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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