@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        :root {
            /* Nature & Luxury Palette - Refined */
            --color-primary: #0a3d26;   /* Deeper Forest Green */
            --color-primary-light: #145a3a;
            --color-secondary: #cfa372; /* Richer Gold/Sand */
            --color-secondary-light: #e0c09a;
            --color-surface: #fdfbf8;   /* Warmest Off-White */
            --color-text: #3d3d3d;
            --color-text-light: #7a7a7a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-surface);
            color: var(--color-text);
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* Global Texture Overlay for Premium Feel */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: multiply;
        }

        /* Typography Override */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.02em;
        }

        /* Utilities */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-gold { color: var(--color-secondary) !important; }
        .bg-surface { background-color: var(--color-surface) !important; }
        
        .text-gradient-gold {
            background: linear-gradient(to right, var(--color-secondary), var(--color-secondary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Innovation: Glassmorphism 2.0 */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
        
        .glass-dark {
            background: rgba(10, 61, 38, 0.85);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }

        /* Premium Buttons */
        .btn-premium {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-premium::after {
            content: '';
            position: absolute;
            top: -50%; right: -50%; bottom: -50%; left: -50%;
            background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transform: rotate(45deg) translate(-100%, -100%);
            transition: transform 0.6s ease;
        }
        .btn-premium:hover::after { transform: rotate(45deg) translate(100%, 100%); }
        .btn-premium:hover { box-shadow: 0 10px 20px -10px rgba(15, 81, 50, 0.5); transform: translateY(-2px); }

        /* Shapes & Dividers */
        .wave-mask-bottom { clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%); }
        .wave-divider { clip-path: polygon(100% 0, 100% 100%, 0 100%, 0 15%, 23% 11%, 43% 18%, 65% 22%, 83% 16%); }

        /* Animations */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
        }
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            opacity: 0; 
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        /* --- NEW ENHANCEMENTS START --- */
        
        /* Promo Marquee */
        .marquee-container {
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        .animate-marquee {
            animation: marquee 30s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Gold Shimmer Effect */
        .shimmer-gold {
            position: relative;
            overflow: hidden;
        }
        .shimmer-gold::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(207, 163, 114, 0.4), transparent);
            transform: skewX(-25deg);
            animation: shimmer 3s infinite;
        }
        @keyframes shimmer {
            100% { left: 200%; }
        }
        
        /* --- NEW ENHANCEMENTS END --- */

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--color-surface); }
        ::-webkit-scrollbar-thumb { background: var(--color-primary); border-radius: 4px; }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section id="jumbotron" class="relative min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img loading="lazy" 
                src="{{ optional($profiles)->background_image ? asset(optional($profiles)->background_image) : asset('assets/images/jumbotron/background-jumbo.png') }}" 
                alt="Java Nature Landscape"
                class="w-full h-full object-cover object-center transform scale-110 transition-transform duration-[30s] hover:scale-100 ease-out">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full h-32 md:h-64 bg-gradient-to-t from-surface to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20 pt-24 md:pt-20">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-8/12 text-left mb-12 lg:mb-0">
                    <div class="inline-flex items-center gap-3 py-2 px-5 rounded-full glass-card text-white/90 text-xs md:text-sm font-semibold mb-6 animate-fade-up tracking-wider uppercase">
                        <i class="fas fa-leaf text-secondary"></i>
                        Premium Java Exploration
                    </div>
                    
                    <h1 class="text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-bold text-white mb-6 leading-[1.1] animate-fade-up drop-shadow-2xl">
                        Discover <br> the <span class="italic text-gradient-gold font-serif">Untamed.</span>
                    </h1>

                    <p class="text-base sm:text-lg md:text-xl text-white/80 mb-8 max-w-xl animate-fade-up font-light leading-relaxed glass-dark p-6 rounded-3xl border-none"
                    style="transition-delay: 0.2s">
                        {{ optional($profiles)->jumbotron_subheading ?? "Curating exclusive journeys to Java's hidden gems. Reconnect with nature in luxury and style." }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 animate-fade-up" style="transition-delay: 0.4s">
                        <a href="#destination"
                        class="btn-premium px-8 py-4 text-center text-white rounded-full font-bold flex items-center justify-center gap-3 group">
                            Begin Journey 
                            <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="{{ route('booking.custom') }}"
                        class="px-8 py-4 text-center text-white glass-card rounded-full hover:bg-white hover:text-primary transition-all duration-300 font-bold border-white/30">
                            Design My Trip
                        </a>
                    </div>
                </div>

                {{-- <div class="lg:w-4/12 hidden lg:flex justify-end animate-fade-up" style="transition-delay: 0.6s">
                    <div class="relative animate-float-slow">
                        <div class="w-72 h-96 rounded-[4rem] overflow-hidden rotate-6 border-4 border-white/20 shadow-2xl relative z-10">
                             <img src="https://images.unsplash.com/photo-1589820296156-2454bb8a4d8f?q=80&w=600&auto=format&fit=crop" alt="Java Culture" class="w-full h-full object-cover">
                             <div class="absolute inset-0 bg-primary/20 mix-blend-multiply"></div>
                        </div>
                        <div class="absolute -top-10 -right-10 w-56 h-56 bg-secondary/30 rounded-full blur-3xl mix-blend-screen -z-10"></div>
                    </div>
                </div> --}}
            </div>
        </div>
        
        <a href="#why-choose-us" class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-white/60 hover:text-white transition-colors z-20 group cursor-pointer animate-fade-up hidden md:flex" style="transition-delay: 1s">
            <span class="text-xs uppercase tracking-[0.3em] mb-2 font-semibold">Scroll</span>
            <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center p-1 relative overflow-hidden">
                <div class="w-1 h-2 bg-white rounded-full animate-bounce mt-1"></div>
            </div>
        </a>
    </section>

    <section id="why-choose-us" class="w-full py-20 md:py-32 relative overflow-hidden bg-surface">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-yellow-200/10 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-float-slow"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-green-200/10 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-float-slow" style="animation-delay: -4s"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 animate-fade-up">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs md:text-sm mb-4 block">Our Promise</span>
                <h3 class="text-4xl md:text-6xl font-bold text-primary mb-6 leading-tight">Why {{ optional($profiles)->website_name ?? "GoingToTheJava"}}?</h3>
                <p class="text-text-light max-w-2xl mx-auto text-lg font-light leading-relaxed">
                    We don't just offer trips; we craft immersive experiences blending luxury with authentic Javanese soul.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['Expert Guidance', 'Curated by insiders who know every hidden path.', 'fas fa-map-marked-alt', 'green'],
                    ['Best Value', 'Luxury experiences at fair pricing with no hidden costs.', 'fas fa-tag', 'yellow'],
                    ['24/7 Concierge', 'Round-the-clock assistance for peace of mind.', 'fas fa-headset', 'blue'],
                    ['Eco-Conscious', 'We prioritize responsible tourism.', 'fas fa-leaf', 'emerald'],
                    ['Flexible Plans', 'Change of plans? We adapt instantly.', 'fas fa-calendar-check', 'indigo'],
                    ['Tailored for You', 'Customizable to your personal rhythm.', 'fas fa-sliders-h', 'purple']
                ] as $index => $feature)
                    <div class="glass-card p-6 rounded-[2rem] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex items-start gap-4 border-white/40 animate-fade-up" style="transition-delay: {{ $index * 0.1 }}s">
                        <div class="shrink-0 w-12 h-12 bg-{{ $feature[3] }}-50 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-{{ $feature[3] }}-600">
                            <i class="{{ $feature[2] }} text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-serif text-xl font-bold text-primary mb-2 group-hover:text-{{ $feature[3] }}-600">{{ $feature[0] }}</h4>
                            <p class="text-text-light text-sm leading-relaxed font-light">{{ $feature[1] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 leaf-pattern opacity-5 mix-blend-overlay"></div>
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
        <div class="absolute -right-40 top-20 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="w-full mb-12 overflow-hidden marquee-container opacity-30 pointer-events-none">
            <div class="whitespace-nowrap flex gap-8 animate-marquee text-4xl md:text-6xl font-serif font-bold text-transparent" style="-webkit-text-stroke: 1px rgba(255,255,255,0.3);">
                <span>LIMITED TIME OFFER &nbsp;&bull;&nbsp; JAVA HIDDEN GEMS &nbsp;&bull;&nbsp; LUXURY ESCAPE &nbsp;&bull;&nbsp; EARLY BIRD DEALS &nbsp;&bull;&nbsp;</span>
                <span>LIMITED TIME OFFER &nbsp;&bull;&nbsp; JAVA HIDDEN GEMS &nbsp;&bull;&nbsp; LUXURY ESCAPE &nbsp;&bull;&nbsp; EARLY BIRD DEALS &nbsp;&bull;&nbsp;</span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 animate-fade-up">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-8 h-[2px] bg-secondary"></span>
                        <span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs">Unmissable Deals</span>
                    </div>
                    <h3 class="text-3xl md:text-5xl font-bold text-white font-serif">Curated Packages</h3>
                </div>
                <div class="hidden md:block">
                    <a href="#destination" class="group flex items-center gap-2 text-white/80 hover:text-white transition-all text-sm uppercase tracking-widest font-semibold">
                        View All Promotions 
                        <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform text-secondary"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <div class="lg:col-span-7 relative h-[500px] rounded-[2.5rem] overflow-hidden group cursor-pointer shadow-2xl border border-white/10 animate-fade-up">
                    <div class="absolute inset-0 bg-gray-900">
                        <img src="https://images.unsplash.com/photo-1505993809837-78bf62d6b38c?q=80&w=1200&auto=format&fit=crop" 
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110 opacity-60 group-hover:opacity-50">
                    </div>
                    
                    <div class="absolute top-6 left-6 flex gap-2">
                        <div class="bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-bold px-4 py-2 rounded-full uppercase tracking-wider">
                            <i class="fas fa-fire text-orange-400 mr-1"></i> Most Popular
                        </div>
                    </div>

                    <div class="absolute top-6 right-6 w-20 h-20 bg-secondary rounded-full flex flex-col items-center justify-center shadow-lg transform group-hover:rotate-12 transition-transform duration-300 z-20 shimmer-gold text-primary">
                        <span class="text-xs font-bold uppercase">Save</span>
                        <span class="text-2xl font-black leading-none">20%</span>
                    </div>

                    <div class="absolute bottom-0 left-0 w-full p-8 md:p-10 bg-gradient-to-t from-black via-black/60 to-transparent">
                        <span class="text-secondary text-sm font-bold uppercase tracking-widest mb-2 block">Nature Series</span>
                        <h4 class="text-3xl md:text-5xl font-bold text-white font-serif mb-4 leading-tight">Bromo Sunrise <br> Elite Expedition</h4>
                        
                        <div class="flex flex-wrap gap-4 text-white/80 text-sm mb-6">
                            <span class="flex items-center gap-2"><i class="fas fa-clock text-secondary"></i> 2 Days 1 Night</span>
                            <span class="flex items-center gap-2"><i class="fas fa-user-friends text-secondary"></i> Private Group</span>
                            <span class="flex items-center gap-2"><i class="fas fa-star text-secondary"></i> Premium Jeep</span>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-white/10">
                            <div class="flex flex-col">
                                <span class="text-white/50 text-xs line-through">IDR 2.500.000</span>
                                <span class="text-white text-xl font-bold">IDR 1.999.000 <span class="text-xs font-normal text-white/60">/pax</span></span>
                            </div>
                            <button class="ml-auto bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-secondary hover:text-white transition-all duration-300 shadow-lg transform hover:-translate-y-1">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 flex flex-col gap-6">
                    
                    <div class="relative flex-1 min-h-[240px] rounded-[2.5rem] overflow-hidden group cursor-pointer shadow-xl border border-white/10 animate-fade-up" style="transition-delay: 0.1s">
                        <img src="https://images.unsplash.com/photo-1604812316629-d5c404642b32?q=80&w=800&auto=format&fit=crop" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-60 group-hover:opacity-50">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/90 to-transparent"></div>

                        <div class="absolute inset-0 p-8 flex flex-col justify-center">
                            <div class="bg-secondary/90 text-primary text-[10px] font-bold px-3 py-1 rounded-full w-fit mb-3 uppercase tracking-wider">
                                Couple Special
                            </div>
                            <h4 class="text-2xl font-bold text-white font-serif mb-2 group-hover:text-secondary transition-colors">Royal Yogyakarta</h4>
                            <p class="text-white/70 text-sm mb-4 line-clamp-2">Romantic dinner at Ramayana Ballet & private palace tour.</p>
                            <span class="text-white font-semibold text-sm flex items-center gap-2 group-hover:gap-4 transition-all">
                                Check Details <i class="fas fa-arrow-right text-secondary"></i>
                            </span>
                        </div>
                    </div>

                    <div class="relative h-[200px] bg-white/5 backdrop-blur-md rounded-[2.5rem] p-8 border border-white/10 hover:border-secondary/50 transition-colors group animate-fade-up flex flex-col justify-between" style="transition-delay: 0.2s">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                        
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <i class="fas fa-sliders-h text-2xl text-secondary"></i>
                                <span class="text-white/40 text-xs uppercase font-bold tracking-widest">Custom Trip</span>
                            </div>
                            <h4 class="text-xl font-bold text-white font-serif leading-tight">Can't find what <br> you're looking for?</h4>
                        </div>

                        <a href="{{ route('booking.custom') }}" class="flex items-center justify-between w-full bg-white/10 hover:bg-white text-white hover:text-primary p-3 rounded-xl transition-all duration-300 group-hover:shadow-lg">
                            <span class="font-bold text-sm ml-2">Design Your Trip</span>
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center group-hover:bg-primary/10">
                                <i class="fas fa-plus text-xs"></i>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="#destination" class="text-white/80 border-b border-white/30 pb-1 text-sm uppercase tracking-widest">View All Packages</a>
            </div>
        </div>
    </section>

    <section id="destination" class="py-20 md:py-32 bg-surface relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 md:mb-20">
                <div class="md:w-1/2 animate-fade-up">
                    <span class="text-secondary uppercase tracking-[0.3em] text-xs font-bold mb-3 block">Top Picks</span>
                    <h2 class="text-4xl md:text-6xl font-bold text-primary leading-tight">Explore the <br><span class="italic text-secondary font-serif">Extraordinary</span></h2>
                </div>
                <div class="md:w-1/3 text-right mt-6 md:mt-0 animate-fade-up" style="transition-delay: 0.2s">
                    <a href="{{ route('destination.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-secondary transition-all group font-semibold">
                        View All <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($destinations->take(2) as $destination)
                <a href="{{ route('destination.show', $destination->slug) }}" class="group relative h-[450px] md:h-[550px] rounded-[2.5rem] overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300 animate-fade-up block">
                    <img loading="lazy" src="{{ asset($destination->destination_photo) }}"
                         alt="{{ $destination->name_package }}"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90"></div>

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

                <div class="relative h-[450px] md:h-[550px] rounded-[2.5rem] overflow-hidden bg-primary p-8 md:p-12 flex flex-col justify-center text-center animate-fade-up border border-white/10 group cursor-pointer" onclick="window.location='{{ route('booking.custom') }}'">
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary/10 rounded-full blur-3xl"></div>
                    <i class="fas fa-magic text-6xl text-secondary/30 mb-6 group-hover:scale-110 transition-transform duration-500 text-white"></i>
                    
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

    <section class="max-w-7xl mx-auto px-6 py-12 md:py-20 border-b border-gray-100">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach([
                ['3.5k+', 'Happy Travelers'],
                ['120+', 'Destinations'],
                ['98%', '5-Star Reviews'],
                ['15+', 'Years Exp.']
            ] as $stat)
                <div class="text-center group animate-fade-up">
                    <h4 class="text-3xl md:text-5xl font-bold text-primary mb-1 font-serif group-hover:scale-110 transition-transform duration-300">{{ $stat[0] }}</h4>
                    <span class="text-text-light text-xs md:text-sm tracking-widest uppercase font-bold">{{ $stat[1] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-surface py-20 md:py-32 overflow-hidden">
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
                    <div class="relative group {{ $index % 2 != 0 ? 'md:translate-y-12' : '' }} transition-all duration-500 animate-fade-up" style="transition-delay: {{ $index * 0.1 }}s">
                        <div class="bg-white p-3 md:p-4 shadow-lg rounded-xl transform transition-all duration-500 group-hover:-rotate-2 group-hover:scale-[1.02] border border-gray-100">
                            <div class="overflow-hidden rounded-lg aspect-[3/4] relative mb-3">
                                <img loading="lazy" src="{{ asset($gallery->gallery_photo) }}"
                                    alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            </div>
                            <div class="text-center hidden md:block">
                                <span class="font-serif text-primary text-sm font-bold">{{ $gallery->title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
             <div class="mt-8 text-center md:hidden">
                <a href="{{ route('gallery.index') }}" class="text-primary underline text-sm">View Full Gallery</a>
            </div>
        </div>
    </section>

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
                                <p class="text-text-light italic text-base md:text-lg leading-relaxed mb-6 font-serif font-light">
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

    <section class="py-20 bg-surface border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 animate-fade-up">
                <span class="text-primary text-xs font-bold tracking-wider uppercase mb-2 block">The Journal</span>
                <h3 class="text-3xl md:text-5xl font-bold text-text font-serif">Travel Inspirations</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group cursor-pointer animate-fade-up">
                    <div class="overflow-hidden rounded-2xl h-64 mb-6 relative">
                        <img src="https://images.unsplash.com/photo-1596402184320-417e7178b2cd?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary">
                            TIPS
                        </div>
                    </div>
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2 block">Oct 12, 2023</span>
                    <h4 class="text-xl font-bold text-primary font-serif mb-3 group-hover:text-secondary transition-colors">Packing Guide for Bromo</h4>
                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">Everything you need to know about preparing for the cold sunrise at King Kong Hill...</p>
                    <span class="inline-block mt-4 text-sm font-semibold text-primary group-hover:translate-x-1 transition-transform">Read Article &rarr;</span>
                </div>

                <div class="group cursor-pointer animate-fade-up" style="transition-delay: 0.1s">
                    <div class="overflow-hidden rounded-2xl h-64 mb-6 relative">
                        <img src="https://images.unsplash.com/photo-1555899434-94d1368d7vd?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary">
                            CULTURE
                        </div>
                    </div>
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2 block">Nov 05, 2023</span>
                    <h4 class="text-xl font-bold text-primary font-serif mb-3 group-hover:text-secondary transition-colors">Hidden Temples of Java</h4>
                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">Beyond Borobudur: Discovering the smaller, mystical ancient sites scattered across the island...</p>
                    <span class="inline-block mt-4 text-sm font-semibold text-primary group-hover:translate-x-1 transition-transform">Read Article &rarr;</span>
                </div>

                <div class="group cursor-pointer animate-fade-up" style="transition-delay: 0.2s">
                    <div class="overflow-hidden rounded-2xl h-64 mb-6 relative">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                         <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary">
                            FOOD
                        </div>
                    </div>
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2 block">Dec 01, 2023</span>
                    <h4 class="text-xl font-bold text-primary font-serif mb-3 group-hover:text-secondary transition-colors">A Culinary Journey in Solo</h4>
                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">Taste the authentic flavors of Central Java, from Gudeg to the best street food spots...</p>
                    <span class="inline-block mt-4 text-sm font-semibold text-primary group-hover:translate-x-1 transition-transform">Read Article &rarr;</span>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-surface relative py-20 md:py-32" id="about">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-primary rounded-[3rem] overflow-hidden shadow-2xl flex flex-col lg:flex-row relative">
                
                <div class="lg:w-1/2 relative min-h-[400px] lg:min-h-auto lg:order-2">
                    <div class="absolute inset-0 z-10 wave-divider bg-primary lg:bg-transparent lg:bg-gradient-to-r from-primary to-transparent pointer-events-none"></div>
                     @if($latestGalleries && $latestGalleries->count() > 0)
                        <img src="{{ asset($latestGalleries->first()->gallery_photo) }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1596401057633-565652b8ddbe?auto=format&fit=crop&w=800&q=80" class="absolute inset-0 w-full h-full object-cover">
                    @endif
                    <div class="absolute inset-0 bg-primary/40 mix-blend-multiply"></div>
                </div>

                <div class="lg:w-1/2 p-8 md:p-16 text-white relative z-20 lg:order-1">
                    <span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs mb-4 block">Let's Talk</span>
                    <h3 class="text-3xl md:text-5xl font-serif font-bold mb-6 leading-tight">Plan Your <span class="italic text-secondary">Dream Trip</span></h3>
                    <p class="text-white/80 mb-8 font-light text-sm md:text-base leading-relaxed">
                        {{ optional($profiles)->about_description ?? "Ready to explore Java authentically? Tell us a bit about your travel style, and we'll curate the perfect experience for you." }}
                    </p>

                    <form action="{{ route('store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="first_name" placeholder="First Name" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 transition-all backdrop-blur-md">
                            <input type="text" name="last_name" placeholder="Last Name" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 transition-all backdrop-blur-md">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 transition-all backdrop-blur-md">
                            <input type="tel" name="phone" placeholder="Phone" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 transition-all backdrop-blur-md">
                        </div>
                        <input type="text" name="country" placeholder="Country" required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 transition-all backdrop-blur-md">
                        <textarea name="message" rows="3" placeholder="Tell us about your trip..." required class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white placeholder-white/40 focus:outline-none focus:bg-white/10 focus:border-secondary/50 transition-all resize-none backdrop-blur-md"></textarea>
                        
                        <button type="submit" class="btn-premium w-full py-4 bg-secondary text-white font-bold text-lg rounded-xl hover:bg-white hover:text-primary transition-all shadow-xl mt-4 flex items-center justify-center gap-2 group">
                            Send Inquiry <i class="fas fa-paper-plane transform group-hover:translate-x-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <a href="https://wa.me/6281220005276?text=Hi%20Septem%20Tour..." 
       target="_blank"
       class="fixed bottom-6 right-6 lg:bottom-10 lg:right-10 w-14 h-14 md:w-16 md:h-16 bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-2xl hover:bg-[#20bd5a] hover:scale-110 transition-all duration-300 z-50 group animate-bounce-slow">
        <i class="fab fa-whatsapp text-3xl md:text-4xl"></i>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
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
        </script>
    @endpush
@endsection