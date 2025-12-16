@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- UNIFIED FONT TO POPPINS ONLY --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* --- Premium Blue Ocean Theme Configuration --- */
        :root {
            --color-primary: #003366;   /* Deep Ocean Navy */
            --color-primary-light: #004080;
            --color-secondary: #00b4d8; /* Pacific Cyan/Sky Blue */
            --color-secondary-light: #90e0ef;
            --color-surface: #f4f8fb;   /* Very Light Blue/White */
            --color-text: #1e293b;
            --color-text-light: #64748b;
            font-family: 'Poppins', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--color-surface);
            color: var(--color-text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* --- Noise Texture Overlay (KEPT: Subtle premium feel, not crowded) --- */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: multiply;
        }
        
        /* REMOVED: .bg-pattern-wave class to simplify background */

        /* --- Typography --- */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.02em;
        }
        
        .text-balance { text-wrap: balance; }

        /* --- Custom Utilities --- */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }
         { background-color: var(--color-surface) !important; }

        /* Blue Sapphire Gradient Text */
        .text-gradient-gold {
            background: linear-gradient(to right, var(--color-secondary), #caf0f8, var(--color-secondary));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 5s linear infinite;
        }
        @keyframes shine { to { background-position: 200% center; } }

        /* --- Glassmorphism Components --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(0, 51, 102, 0.08);
        }

        .glass-dark {
            background: rgba(0, 51, 102, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.25);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-premium::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: 0.5s;
        }
        .btn-premium:hover::after { left: 100%; }
        .btn-premium:hover { box-shadow: 0 10px 25px -5px rgba(0, 51, 102, 0.4); transform: translateY(-2px); }

        /* --- Animations --- */
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .animate-fade-up {
            opacity: 0; transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        /* Marquee */
        .marquee-container {
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        .animate-marquee { animation: marquee 40s linear infinite; }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--color-surface); }
        ::-webkit-scrollbar-thumb { background: var(--color-primary); border-radius: 4px; }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- 1. HERO / JUMBOTRON SECTION --}}
    <section id="jumbotron" class="relative min-h-[100vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img 
                src="{{ optional($profiles)->background_image ? asset(optional($profiles)->background_image) : asset('assets/images/jumbotron/background-jumbo.png') }}" 
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1592345279419-959d784e8aad?q=80&w=1200';"
                alt="Java Nature Landscape"
                class="w-full h-full object-cover object-center transform scale-105 animate-float-slow" 
                style="animation-duration: 20s;">
            
            <div class="absolute inset-0 bg-gradient-to-b from-[#003366]/40 via-black/10 to-transparent mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#001122]/80 via-[#003366]/30 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-t from-[var(--color-surface)] to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20 pt-20">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-9/12 text-left mb-12 lg:mb-0">
                    <div class="inline-flex items-center gap-3 py-2 px-5 rounded-full glass-card text-primary font-bold text-xs md:text-sm mb-6 animate-fade-up tracking-wider uppercase backdrop-blur-md">
                        <i class="fas fa-compass text-secondary"></i>
                        Premium Java Exploration
                    </div>
                    
                    <h1 class="text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-bold text-white mb-6 leading-[1.1] animate-fade-up drop-shadow-2xl font-serif text-balance">
                        Discover <br> the <span class="italic text-gradient-gold">Untamed.</span>
                    </h1>

                    <p class="text-base sm:text-lg md:text-xl text-white/90 mb-8 max-w-xl animate-fade-up font-light leading-relaxed glass-dark p-6 rounded-3xl border border-white/10"
                    style="animation-delay: 0.2s">
                        {{ optional($profiles)->jumbotron_subheading ?? "Curating exclusive journeys to Java's hidden gems. Reconnect with nature in luxury and style." }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 animate-fade-up" style="animation-delay: 0.4s">
                        <a href="#destination"
                        class="btn-premium px-10 py-4 text-center text-white rounded-full font-bold flex items-center justify-center gap-3 group shadow-lg shadow-blue-900/30">
                            Begin Journey 
                            <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="{{ route('booking.custom') }}"
                        class="px-10 py-4 text-center text-white glass-card rounded-full transition-all duration-300 font-bold border-white/20">
                            Design My Trip
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="#why-choose-us" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-white/60 hover:text-white transition-colors z-20 group cursor-pointer animate-fade-up hidden md:flex" style="animation-delay: 1s">
            <span class="text-[10px] uppercase tracking-[0.3em] mb-2 font-semibold">Scroll Down</span>
            <div class="w-5 h-9 border-2 border-white/30 rounded-full flex justify-center p-1 relative overflow-hidden">
                <div class="w-1.5 h-1.5 bg-white rounded-full animate-bounce mt-1"></div>
            </div>
        </a>
    </section>

    {{-- 2. WHY CHOOSE US --}}
    <section id="why-choose-us" class="w-full py-20 md:py-32 relative overflow-hidden">
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 animate-fade-up">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs md:text-sm mb-4 block">Our Promise</span>
                <h3 class="text-4xl md:text-6xl font-bold text-primary mb-6 leading-tight font-serif text-balance">Why {{ optional($profiles)->website_name ?? "GoingToTheJava"}}?</h3>
                <p class="text-text-light max-w-2xl mx-auto text-lg font-light leading-relaxed text-balance">
                    We don't just offer trips; we craft immersive experiences blending luxury with authentic Javanese soul.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach([
        ['Expert Guidance', 'Curated by insiders who know every hidden path.', 'fas fa-map-marked-alt', 'bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white'],
        ['Best Value', 'Luxury experiences at fair pricing with no hidden costs.', 'fas fa-tag', 'bg-cyan-50 text-cyan-600 group-hover:bg-cyan-600 group-hover:text-white'],
        ['24/7 Concierge', 'Round-the-clock assistance for peace of mind.', 'fas fa-headset', 'bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white'],
        ['Eco-Conscious', 'We prioritize responsible tourism and sustainability.', 'fas fa-leaf', 'bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white'],
        ['Flexible Plans', 'Change of plans? We adapt instantly to your needs.', 'fas fa-calendar-check', 'bg-sky-50 text-sky-600 group-hover:bg-sky-600 group-hover:text-white'],
        ['Tailored for You', 'Customizable to your personal rhythm and style.', 'fas fa-sliders-h', 'bg-violet-50 text-violet-600 group-hover:bg-violet-600 group-hover:text-white']
    ] as $feature)
        <div class="glass-card p-8 rounded-[2rem] hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group flex flex-col items-start gap-4 border border-white/60 hover:border-secondary/30 animate-fade-up">
            
            {{-- Bagian Icon --}}
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-300 {{ $feature[3] }}">
                <i class="{{ $feature[2] }} text-xl"></i>
            </div>

            <div>
                <h4 class="font-serif text-xl font-bold text-primary mb-2 group-hover:text-secondary transition-colors">{{ $feature[0] }}</h4>
                <p class="text-text-light text-sm leading-relaxed font-light">{{ $feature[1] }}</p>
            </div>
        </div>
    @endforeach
</div>
        </div>
    </section>

    {{-- 3. PROMOTION BANNER 1 --}}
    @if(optional($profiles)->promotion_banner_1)
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[2.5rem] overflow-hidden shadow-2xl relative group animate-fade-up">
                <a href="#destination">
                    <img src="{{ asset($profiles->promotion_banner_1) }}" 
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1682687220742-aba13b6e50ba?q=80&w=1600&auto=format&fit=crop';"
                         class="w-full h-48 md:h-80 object-cover transform group-hover:scale-105 transition-transform duration-700" 
                         alt="Special Promotion">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent group-hover:from-black/40 transition-colors"></div>
                    <div class="absolute bottom-0 left-0 p-8 md:p-12">
                        <span class="bg-secondary text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3 inline-block">Limited Offer</span>
                        <h3 class="text-3xl md:text-5xl font-serif font-bold text-white mb-2">Explore Java's Hidden Gems</h3>
                        <p class="text-white/90 hidden md:block">Don't miss out on our exclusive seasonal packages.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- 4. BOOKING PROCESS --}}
    <section id="booking-process" class="py-24 relative overflow-hidden">

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 animate-fade-up">
                <span class="bg-primary/10 text-primary px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase mb-4 inline-block">
                    How To Book
                </span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-primary mb-4">Easy Booking Process</h2>
                <p class="text-text-light max-w-2xl mx-auto">
                    Whether you choose a ready-made package or create your own adventure, booking with us is simple and hassle-free.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl border border-gray-100 animate-fade-up flex flex-col h-full hover:border-primary/20 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center text-xl">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary font-serif">Regular Package</h3>
                    </div>
                    <p class="text-gray-600 mb-8">Choose from our curated destinations and book in just a few steps.</p>
                    <div class="space-y-8 mb-10 flex-grow">
                        @foreach(['Choose Destination', 'View Details', 'Fill Out Booking Form', 'Submit & Wait Confirmation'] as $index => $step)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md">{{ $index + 1 }}</div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $step }}</h4>
                                <p class="text-sm text-gray-500 mt-1">Step details for {{ strtolower($step) }}.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="#destination" class="w-full py-4 bg-primary text-white rounded-xl font-bold text-center hover:bg-primary-light transition-colors shadow-lg shadow-primary/20 mt-auto flex items-center justify-center gap-2">
                        Explore Destinations <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="bg-primary p-8 md:p-10 rounded-[2.5rem] shadow-xl shadow-primary/30 animate-fade-up flex flex-col h-full text-white relative overflow-hidden" style="animation-delay: 0.2s">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                    <div class="flex items-center gap-4 mb-8 relative z-10">
                        <div class="w-12 h-12 bg-white/20 text-white rounded-2xl flex items-center justify-center text-xl backdrop-blur-sm">
                            <i class="fas fa-magic"></i>
                        </div>
                        <h3 class="text-2xl font-bold font-serif">Custom Trip</h3>
                    </div>
                    <p class="text-gray-200 mb-8 relative z-10">Want something unique? Tell us your dream trip and we'll make it happen.</p>
                    <div class="space-y-8 mb-10 flex-grow relative z-10">
                        @foreach(['Select Custom Option', 'Fill Out Custom Form', 'Submit Request', 'Wait for Follow-Up'] as $index => $step)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-white text-primary rounded-full flex items-center justify-center font-bold text-sm shadow-md">{{ $index + 1 }}</div>
                            <div>
                                <h4 class="font-bold text-white">{{ $step }}</h4>
                                <p class="text-sm text-gray-300 mt-1">Details regarding {{ strtolower($step) }}.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('booking.custom') }}" class="w-full py-4 bg-white text-primary rounded-xl font-bold text-center hover:bg-gray-100 transition-colors shadow-lg mt-auto flex items-center justify-center gap-2 relative z-10">
                        Customize Your Trip <i class="fas fa-magic"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. PROMOTION BANNER 2 --}}
    @if(optional($profiles)->promotion_banner_2)
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[2.5rem] overflow-hidden shadow-2xl relative group animate-fade-up">
                <a href="#destination">
                    <img src="{{ asset($profiles->promotion_banner_2) }}" 
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1600&auto=format&fit=crop';"
                         class="w-full h-48 md:h-80 object-cover transform group-hover:scale-105 transition-transform duration-700" 
                         alt="Limited Offer">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 w-full text-center md:text-left">
                        <h3 class="text-2xl md:text-4xl font-serif font-bold text-white mb-2">Adventure Awaits</h3>
                        <p class="text-white/90">Book now and get special discounts for groups.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- 6. DESTINATIONS --}}
    {{-- Reverted to simple --}}
    <section id="destination" class="py-20 md:py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 md:mb-20">
                <div class="md:w-1/2 animate-fade-up">
                    <span class="text-secondary uppercase tracking-[0.3em] text-xs font-bold mb-3 block">Top Picks</span>
                    <h2 class="text-4xl md:text-6xl font-bold text-primary leading-tight font-serif text-balance">Explore the <br><span class="italic text-secondary">Extraordinary</span></h2>
                </div>
                <div class="md:w-1/3 text-right mt-6 md:mt-0 animate-fade-up" style="animation-delay: 0.2s">
                    <a href="{{ route('destination.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-secondary transition-all group font-semibold">
                        View All <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($destinations->take(2) as $destination)
                <a href="{{ route('destination.show', $destination->slug) }}" class="group relative h-[450px] md:h-[550px] rounded-[2.5rem] overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-up block">
                    <img loading="lazy" src="{{ asset($destination->destination_photo) }}"
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1000';"
                         alt="{{ $destination->name_package }}"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80"></div>

                    <div class="absolute bottom-0 left-0 w-full p-8 z-20 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="flex flex-wrap gap-2 mb-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            @foreach(array_slice(explode(',', $destination->activities), 0, 2) as $activity)
                                @if(trim($activity))
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-[10px] font-semibold text-white border border-white/20 uppercase tracking-wider">
                                        {{ trim($activity) }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                        
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-2 font-serif group-hover:text-secondary transition-colors">{{ $destination->name_package }}</h3>
                        <p class="text-white/90 text-lg font-medium">IDR {{ number_format($destination->price, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach

                <div class="relative h-[450px] md:h-[550px] rounded-[2.5rem] overflow-hidden bg-primary p-8 md:p-12 flex flex-col justify-center text-center animate-fade-up border border-white/10 group cursor-pointer hover:shadow-2xl transition-all duration-300" onclick="window.location='{{ route('booking.custom') }}'">
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary/10 rounded-full blur-3xl group-hover:bg-secondary/20 transition-colors"></div>
                    <i class="fas fa-magic text-6xl text-white text-secondary/30 mb-6 group-hover:scale-110 group-hover:text-secondary transition-all duration-500"></i>
                    
                    <h3 class="text-3xl md:text-4xl font-bold text-white mb-4 font-serif">Tailor-Made <br> Trip</h3>
                    <p class="text-white/70 mb-8 text-sm md:text-base leading-relaxed">
                        Don't fit in a box? Let our travel architects craft a unique itinerary just for you.
                    </p>
                    <div class="mx-auto btn-premium px-8 py-3 rounded-full text-white font-bold text-sm shadow-lg">
                        Start Designing
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 7. STATS --}}
    <section class="max-w-7xl mx-auto px-6 py-12 md:py-20 border-b border-gray-100">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach([
                ['3.5k+', 'Happy Travelers'],
                ['120+', 'Destinations'],
                ['98%', '5-Star Reviews'],
                ['15+', 'Years Exp.']
            ] as $stat)
                <div class="text-center group animate-fade-up">
                    <h4 class="text-3xl md:text-5xl font-bold text-primary mb-1 font-serif group-hover:text-secondary transition-colors duration-300">{{ $stat[0] }}</h4>
                    <span class="text-text-light text-xs md:text-sm tracking-widest uppercase font-bold">{{ $stat[1] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 8. GALLERY --}}
    {{-- Reverted to simple --}}
    <section class= py-20 md:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 animate-fade-up">
                <div>
                    <span class="text-primary text-xs font-bold tracking-wider uppercase mb-2 block">Visual Stories</span>
                    <h3 class="text-3xl md:text-5xl font-bold text-text font-serif">Captured Moments</h3>
                </div>
                <a href="{{ route('gallery.index') }}" class="hidden md:block text-primary hover:text-secondary font-medium transition-colors border-b border-primary/20 hover:border-secondary">View Full Gallery</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                @foreach ($galleries->take(4) as $index => $gallery)
                    <div class="relative group {{ $index % 2 != 0 ? 'md:translate-y-12' : '' }} transition-all duration-500 animate-fade-up" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="bg-white p-3 md:p-4 shadow-xl shadow-gray-100 rounded-xl transform transition-all duration-500 group-hover:-rotate-2 group-hover:scale-[1.02] border border-gray-50">
                            <div class="overflow-hidden rounded-lg aspect-[3/4] relative mb-3">
                                <img loading="lazy" src="{{ asset($gallery->gallery_photo) }}"
                                    onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=800';"
                                    alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            </div>
                            <div class="text-center hidden md:block">
                                <span class="font-serif text-primary text-sm font-bold">{{ Str::limit($gallery->title, 20) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
             <div class="mt-20 text-center md:hidden">
                <a href="{{ route('gallery.index') }}" class="text-primary underline text-sm font-semibold">View Full Gallery</a>
            </div>
        </div>
    </section>

    {{-- 9. TESTIMONIALS --}}
    <section class="py-20 bg-gray-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h3 class="text-3xl md:text-5xl font-bold text-primary font-serif">Stories from the Road</h3>
                <div class="w-16 h-1 bg-secondary mx-auto rounded-full mt-4 mb-4"></div>
            </div>

            <div class="swiper testimonial-swiper pb-12 !overflow-visible">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimoni)
                        <div class="swiper-slide h-auto">
                            <div class="glass-card p-8 rounded-[2rem] shadow-sm border-white/60 h-full flex flex-col items-center text-center relative mx-2 bg-white/80">
                                <div class="text-secondary mb-6 text-sm">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $testimoni->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                                <p class="text-text-light italic text-base md:text-lg leading-relaxed mb-6 font-serif font-light text-balance">
                                    "{{ $testimoni->content }}"
                                </p>
                                <div class="mt-auto">
                                    <h4 class="font-bold text-primary">{{ $testimoni->name }}</h4>
                                    <span class="text-xs text-text-light uppercase tracking-wider">{{ $testimoni->location }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination !bottom-0"></div>
            </div>
        </div>
    </section>

    {{-- 10. LATEST BLOGS --}}
    {{-- Reverted to simple --}}
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 animate-fade-up">
                <span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs mb-3 block">Travel Journal</span>
                <h3 class="text-4xl md:text-5xl font-serif font-bold text-primary">Inspiration & Stories</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Mengambil hanya 3 artikel terbaru --}}
                @forelse($blogs->take(3) as $blog)
                <div class="group cursor-pointer animate-fade-up">
                    <div class="overflow-hidden rounded-[2rem] h-64 mb-6 relative shadow-md">
                        {{-- Pastikan nama kolom gambar sesuai database (image_path atau image) --}}
                        <img src="{{ asset($blog->image_path ?? $blog->image) }}" 
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=800';"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-bold text-primary tracking-wide shadow-sm uppercase">
                            {{ $blog->category ?? 'Travel' }}
                        </div>
                    </div>
                    
                    <div class="flex items-center text-gray-400 text-xs font-bold uppercase tracking-widest mb-3 gap-3">
                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                        <span class="w-1 h-1 bg-secondary rounded-full"></span>
                        <span>{{ $blog->time_read ?? '5' }} MIN READ</span>
                    </div>
                    
                    <h4 class="text-xl font-serif font-bold text-primary mb-3 group-hover:text-secondary transition-colors line-clamp-2">
                        <a href="{{ route('blogs.detail', $blog->title) }}">{{ $blog->title }}</a>
                    </h4>
                    
                    <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed mb-4">
                        {{ Str::limit(strip_tags($blog->content), 100) }}
                    </p>
                    
                    <a href="{{ route('blogs.detail', $blog->title) }}" class="inline-flex items-center text-sm font-bold text-primary group-hover:translate-x-1 transition-transform border-b-2 border-primary/20 pb-1 group-hover:border-secondary group-hover:text-secondary">
                        Read Article <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
                @empty
                {{-- Dummy Data jika tidak ada blog (Tetap ditampilkan agar layout tidak kosong saat development) --}}
                <div class="group cursor-pointer animate-fade-up">
                    <div class="overflow-hidden rounded-[2rem] h-64 mb-6 relative shadow-md">
                        <img src="https://images.unsplash.com/photo-1596402184320-417e7178b2cd?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-bold text-primary tracking-wide shadow-sm">TIPS</div>
                    </div>
                    <h4 class="text-xl font-serif font-bold text-primary mb-2">Packing Guide for Bromo</h4>
                    <p class="text-gray-500 text-sm mb-4">Essential tips for the cold sunrise.</p>
                    <span class="text-sm font-bold text-primary">Read Article &rarr;</span>
                </div>
                <div class="group cursor-pointer animate-fade-up">
                    <div class="overflow-hidden rounded-[2rem] h-64 mb-6 relative shadow-md">
                        <img src="https://images.unsplash.com/photo-1555899434-94d1368d7vd?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-bold text-primary tracking-wide shadow-sm">CULTURE</div>
                    </div>
                    <h4 class="text-xl font-serif font-bold text-primary mb-2">Hidden Temples of Java</h4>
                    <p class="text-gray-500 text-sm mb-4">Discover ancient mysticism.</p>
                    <span class="text-sm font-bold text-primary">Read Article &rarr;</span>
                </div>
                <div class="group cursor-pointer animate-fade-up">
                    <div class="overflow-hidden rounded-[2rem] h-64 mb-6 relative shadow-md">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-bold text-primary tracking-wide shadow-sm">FOOD</div>
                    </div>
                    <h4 class="text-xl font-serif font-bold text-primary mb-2">Culinary Journey in Solo</h4>
                    <p class="text-gray-500 text-sm mb-4">Authentic flavors of Central Java.</p>
                    <span class="text-sm font-bold text-primary">Read Article &rarr;</span>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 11. CONTACT / ABOUT --}}
    <section class="w-full relative py-20 md:py-32" id="about">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-primary rounded-[3rem] overflow-hidden shadow-2xl flex flex-col lg:flex-row relative">
                
                <div class="lg:w-1/2 relative min-h-[400px] lg:min-h-auto lg:order-2">
                    <div class="absolute inset-0 z-10 wave-divider bg-primary lg:bg-transparent lg:bg-gradient-to-r from-primary to-transparent pointer-events-none"></div>
                     @if($latestGalleries && $latestGalleries->count() > 0)
                        <img src="{{ asset($latestGalleries->first()->gallery_photo) }}" 
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1596401057633-565652b8ddbe?auto=format&fit=crop&w=800&q=80';"
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1596401057633-565652b8ddbe?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover">
                    @endif
                    <div class="absolute inset-0 bg-primary/40 mix-blend-multiply"></div>
                </div>

                <div class="lg:w-1/2 p-8 md:p-16 text-white relative z-20 lg:order-1">
                    <span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs mb-4 block">Let's Talk</span>
                    <h3 class="text-3xl md:text-5xl font-serif font-bold mb-6 leading-tight">Plan Your <span class="italic text-secondary">Dream Trip</span></h3>
                    <p class="text-white/80 mb-8 font-light text-sm md:text-base leading-relaxed text-balance">
                        {{ optional($profiles)->about_description ?? "Ready to explore Java authentically? Tell us a bit about your travel style, and we'll curate the perfect experience for you." }}
                    </p>

                    <form action="{{ route('store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="first_name" placeholder="First Name" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50 transition-all backdrop-blur-md">
                            <input type="text" name="last_name" placeholder="Last Name" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50 transition-all backdrop-blur-md">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50 transition-all backdrop-blur-md">
                            <input type="tel" name="phone" placeholder="Phone" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50 transition-all backdrop-blur-md">
                        </div>
                        <input type="text" name="country" placeholder="Country" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50 transition-all backdrop-blur-md">
                        <textarea name="message" rows="3" placeholder="Tell us about your trip..." required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50 transition-all resize-none backdrop-blur-md"></textarea>
                        
                        <button type="submit" class="btn-premium w-full py-4 bg-secondary text-white font-bold text-lg rounded-xl hover:bg-white hover:text-primary transition-all shadow-xl mt-4 flex items-center justify-center gap-2 group">
                            Send Inquiry <i class="fas fa-paper-plane transform group-hover:translate-x-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Floating WhatsApp (KEPT GREEN AS REQUESTED) --}}
    <a 
        href="https://wa.me/6281217006076?text=Hello%20GOING%20TO%20THE%20JAVA!%20I%27d%20like%20to%20get%20some%20information%3A%0A-%20Destination%3A%20%5BEnter%20your%20preferred%20destination%5D%0A-%20Number%20of%20Travelers%3A%20%5BEnter%20number%5D%0A-%20Travel%20Date%3A%20%5BEnter%20date%5D%0A-%20Email%3A%20%5BEnter%20your%20email%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
        target="_blank"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group animate-bounce-slow"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium whitespace-nowrap">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
        <script>
             var swiper = new Swiper(".testimonial-swiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 1, spaceBetween: 20 },
                    768: { slidesPerView: 2, spaceBetween: 30, centeredSlides: false },
                    1024: { slidesPerView: 2.5, spaceBetween: 40, centeredSlides: true },
                },
            });

            // Navbar Blur Effect on Scroll
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('nav');
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-md');
                    navbar.classList.remove('bg-transparent');
                } else {
                    navbar.classList.remove('bg-white/90', 'backdrop-blur-md', 'shadow-md');
                    navbar.classList.add('bg-transparent');
                }
            });
        </script>
    @endpush
@endsection