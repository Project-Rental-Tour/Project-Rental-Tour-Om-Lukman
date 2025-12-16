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

        /* --- Noise Texture Overlay --- */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: multiply;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.02em;
        }
        
        .text-balance { text-wrap: balance; }

        /* --- Custom Utilities --- */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }
        .bg-surface { background-color: var(--color-surface) !important; }

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

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--color-surface); }
        ::-webkit-scrollbar-thumb { background: var(--color-primary); border-radius: 4px; }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HERO SECTION --}}
    <section id="jumbotron" class="relative min-h-[50vh] flex items-center overflow-hidden bg-primary">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1920&q=80" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1596401057633-565652b8ddbe?auto=format&fit=crop&w=800&q=80';"
                 alt="About Us Background" 
                 class="w-full h-full object-cover object-center animate-float-slow"
                 style="opacity: 0.6;">
            
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 via-[#003366]/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-3xl animate-fade-up text-center mx-auto md:text-left md:mx-0">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block shadow-secondary/20">Who We Are</span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-serif leading-tight">Crafting <span class="italic text-secondary">Unforgettable</span> <br> Journeys</h1>
                <p class="text-lg text-white/80 leading-relaxed font-light">
                    We are passionate about connecting travelers with the authentic beauty, culture, and adventure of Indonesia and beyond.
                </p>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <section class="max-w-7xl mx-auto px-6 py-20 bg-surface -mt-10 relative z-20 rounded-t-[3rem] shadow-[0_-20px_40px_rgba(0,0,0,0.05)]">
        {{-- Background Blobs --}}


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start relative z-10">

            {{-- Left Column --}}
            <div class="space-y-10">
                <div class="rounded-[2.5rem] overflow-hidden shadow-2xl shadow-blue-900/10 relative h-[400px] group animate-fade-up">
                    <img src="{{ asset('assets/images/about_image.jpeg') }}"
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80';"
                         alt="Our Team"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/80 to-transparent opacity-80"></div>
                    <div class="absolute bottom-8 left-8 right-8 text-white">
                        <p class="font-serif text-xl italic text-balance">"Our team is ready to make your dream trip come true — anytime, anywhere."</p>
                    </div>
                </div>

                <div class="glass-card bg-white p-8 rounded-[2rem] shadow-xl border border-white/60 animate-fade-up" style="animation-delay: 0.2s">
                    <h3 class="text-2xl font-bold text-primary font-serif mb-2">Get in Touch</h3>
                    <p class="text-text-light mb-8 text-sm">
                        Have questions? Our dedicated team is here to assist you every step of the way.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-secondary/30 hover:bg-white transition-all group">
                            <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center group-hover:bg-secondary group-hover:text-white transition-colors">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">Email Us</h4>
                                <a href="mailto:goingtothejava@gmail.com" class="text-text-light text-sm hover:text-primary transition-colors">
                                    goingtothejava@gmail.com
                                </a>
                            </div>
                        </div>

                        {{-- WhatsApp (Kept Green) --}}
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-green-200 hover:bg-white transition-all group">
                            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">WhatsApp Support</h4>
                                <div class="flex gap-4 text-sm mt-1">
                                    <a href="https://wa.me/6281217006076" target="_blank" class="text-text-light hover:text-green-600 font-medium">+62 812 2000 5276</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="https://wa.me/6281217006076" target="_blank" class="text-text-light hover:text-green-600 font-medium">+62 812 1700 6076</a>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-secondary/30 hover:bg-white transition-all group">
                            <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center group-hover:bg-secondary group-hover:text-white transition-colors">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">Our Office</h4>
                                <p class="text-text-light text-sm">Malang, East Java, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-10 lg:mt-10">
                <div class="animate-fade-up">
                    <span class="text-secondary font-bold tracking-widest uppercase text-xs mb-3 block">Our Philosophy</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary font-serif mb-6">More Than Just A Trip</h2>
                    <p class="text-text-light leading-relaxed mb-6 text-lg font-light">
                        Founded in 2010, our journey began with a simple dream: to make meaningful travel accessible to everyone. 
                        Today, we've helped over 15,000 travelers explore hidden gems, experience local cultures, and create memories that last a lifetime.
                    </p>
                    <p class="text-text-light leading-relaxed text-lg font-light">
                        We believe travel is about connection, discovery, and transformation. That’s why every trip we design is crafted with care, sustainability, and authenticity in mind.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all group animate-fade-up" style="animation-delay: 0.2s">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
                            <i class="fas fa-mountain text-xl"></i>
                        </div>
                        <h3 class="font-bold text-primary mb-2 font-serif">Adventure</h3>
                        <p class="text-sm text-text-light">We seek the extraordinary in every journey, going beyond the beaten path.</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all group animate-fade-up" style="animation-delay: 0.3s">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="fas fa-leaf text-xl"></i>
                        </div>
                        <h3 class="font-bold text-primary mb-2 font-serif">Sustainability</h3>
                        <p class="text-sm text-text-light">We travel responsibly, minimizing impact and supporting local communities.</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all group animate-fade-up" style="animation-delay: 0.4s">
                        <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-4 group-hover:bg-secondary group-hover:text-white transition-colors">
                            <i class="fas fa-heart text-xl"></i>
                        </div>
                        <h3 class="font-bold text-primary mb-2 font-serif">Passion</h3>
                        <p class="text-sm text-text-light">We pour our hearts into crafting every itinerary for the best experience.</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all group animate-fade-up" style="animation-delay: 0.5s">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <h3 class="font-bold text-primary mb-2 font-serif">Trust</h3>
                        <p class="text-sm text-text-light">Your safety and satisfaction are our top priorities, always.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Floating WhatsApp (KEPT GREEN) --}}
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
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    @endpush
@endsection