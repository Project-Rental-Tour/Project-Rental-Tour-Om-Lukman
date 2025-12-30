@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- UNIFIED FONT TO POPPINS ONLY --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script> -->
    <script src="{{ asset('assets/js/all.min.js') }}"></script>

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
        
        /* Utilities */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }
        .bg-surface { background-color: var(--color-surface) !important; }

        /* Animation */
        .animate-fade-up {
            opacity: 0; transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

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
            {{-- Menggunakan background image profile atau default --}}
            <img src="{{ optional($profiles)->background_image ? asset($profiles->background_image) : asset('assets/images/bg_header_destination.png') }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1920&q=80';"
                 alt="Car Fleet Background" 
                 class="w-full h-full object-cover object-center opacity-40 animate-float-slow">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 via-[#003366]/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-3xl animate-fade-up text-center mx-auto md:text-left md:mx-0">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block shadow-secondary/20">Premium Transport</span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-serif leading-tight">Choose Your <br><span class="italic text-secondary">Perfect Ride</span></h1>
                <p class="text-lg text-white/80 leading-relaxed font-light">
                    From city cruisers to spacious family vans. Explore our well-maintained fleet designed for comfort, safety, and style across Java.
                </p>
            </div>
        </div>
    </section>

    {{-- CAR GRID --}}
    <section class="max-w-7xl mx-auto px-6 py-20 bg-surface -mt-10 relative z-20 rounded-t-[3rem] shadow-[0_-20px_40px_rgba(0,0,0,0.05)]">
        
        {{-- Optional: Filter Categories (Simple Pills) --}}
        @if(isset($carTypes) && count($carTypes) > 0)
        <div class="flex flex-wrap gap-3 mb-12 justify-center md:justify-start relative z-10 animate-fade-up">
            <a href="{{ route('usercar.index') }}" 
               class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ !request('type') ? 'bg-primary text-white shadow-lg' : 'bg-white text-gray-500 hover:text-primary border border-gray-100' }}">
                All Cars
            </a>
            @foreach($carTypes as $type)
            <a href="{{ route('usercar.index', ['type' => $type]) }}" 
               class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ request('type') == $type ? 'bg-primary text-white shadow-lg' : 'bg-white text-gray-500 hover:text-primary border border-gray-100' }}">
                {{ ucfirst($type) }}
            </a>
            @endforeach
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
            
            {{-- Loop Cars (Menggantikan Loop Destinations) --}}
            @forelse ($cars as $car)
                <div class="bg-white rounded-[2rem] shadow-lg shadow-blue-900/5 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-fade-up h-full flex flex-col group border border-white/60">
                    <div class="relative h-56 overflow-hidden">
                        {{-- Image Logic --}}
                        <img loading="lazy" src="{{ asset($car->image_car_1) }}"
                            alt="{{ $car->name_car }}"
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=1000';"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/60 to-transparent opacity-60"></div>
                        
                        {{-- Price Tag --}}
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-primary shadow-sm border border-white/50">
                            IDR {{ number_format($car->price, 0, ',', '.') }} /day
                        </div>

                        {{-- Category Tag --}}
                        <div class="absolute top-4 left-4">
                             <span class="px-2 py-1 bg-[#003366]/80 backdrop-blur-md rounded-md text-[10px] font-bold text-white uppercase tracking-wider">
                                {{ $car->car_type }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-primary mb-3 font-serif group-hover:text-secondary transition-colors">{{ $car->name_car }}</h3>

                        {{-- Features / Activities Replacement --}}
                        <div class="flex flex-wrap gap-2 mb-6">
                            {{-- Feature 1: Capacity --}}
                            <span class="bg-gray-50 text-gray-600 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide border border-gray-200 group-hover:border-secondary/20 transition-colors">
                                <i class="fas fa-users mr-1 text-secondary"></i> {{ $car->capacity }} Seats
                            </span>
                            
                            {{-- Feature 2: Transmission --}}
                            <span class="bg-gray-50 text-gray-600 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide border border-gray-200 group-hover:border-secondary/20 transition-colors">
                                <i class="fas fa-cogs mr-1 text-secondary"></i> {{ $car->transmission }}
                            </span>
                        </div>

                        <a href="{{ route('car.detail', $car->slug) }}"
                            class="w-full mt-auto py-3 rounded-xl font-bold text-sm transition-all duration-300 flex items-center justify-center border-2 border-primary/10 text-primary group-hover:bg-primary group-hover:text-white group-hover:border-transparent">
                            View Details <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">No cars found matching your criteria.</p>
                    <a href="{{ route('usercar.index') }}" class="text-primary font-bold hover:underline">Clear Filters</a>
                </div>
            @endforelse

            {{-- Custom/Contact Card --}}
            <div class="bg-primary rounded-[2rem] shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-fade-up cursor-pointer group relative flex flex-col justify-center items-center text-center p-8 border border-white/10"
                 onclick="window.location='https://wa.me/6281217006076'">
                
                {{-- Decorative circles --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-secondary/20 transition-colors"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -ml-16 -mb-16 group-hover:bg-secondary/20 transition-colors"></div>

                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform border border-white/20 backdrop-blur-sm">
                        <i class="fas fa-headset text-3xl text-secondary"></i>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white mb-3 font-serif">Need Help?</h3>
                    <p class="text-white/70 text-sm mb-8 leading-relaxed font-light">
                        Not sure which car fits your trip? Contact us for a personal recommendation.
                    </p>

                    <button class="px-8 py-3 bg-secondary text-white rounded-full font-bold text-sm hover:bg-white hover:text-primary transition-all duration-300 shadow-lg shadow-secondary/30">
                        Chat with Us <i class="fab fa-whatsapp ml-2"></i>
                    </button>
                </div>
            </div>

        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $cars->links() }}
        </div>
    </section>

    {{-- Floating WhatsApp (KEPT GREEN) --}}
    <a 
        href="https://api.whatsapp.com/send?phone=6281217006076&text=Halo%20Admin%20GOING%20TO%20THE%20JAVA%2C%20saya%20mau%20tanya%20tentang%20paket%20wisata.%20Boleh%20dibantu%3F"
   target="_blank"
   rel="noopener noreferrer"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group animate-bounce-slow"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium whitespace-nowrap">Rent Now</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    @endpush
@endsection