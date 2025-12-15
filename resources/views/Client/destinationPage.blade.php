@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* --- Premium Green Theme Configuration (Same as Master) --- */
        :root {
            --color-primary: #0a3d26;   /* Deep Forest Green */
            --color-primary-light: #145a3a;
            --color-secondary: #cfa372; /* Luxury Gold */
            --color-secondary-light: #e0c09a;
            --color-surface: #fdfbf8;   /* Off-White/Paper */
            --color-text: #3d3d3d;
            --color-text-light: #7a7a7a;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-surface);
            color: var(--color-text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* --- Typography --- */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.01em;
        }
        
        /* --- Custom Utilities --- */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }
        .bg-surface { background-color: var(--color-surface) !important; }

        /* --- Animations --- */
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
        
        .leaf-pattern {
            background-image: radial-gradient(#ffffff 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HERO SECTION --}}
    <section id="jumbotron" class="relative min-h-[50vh] flex items-center overflow-hidden bg-primary">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/bg_header_destination.png') }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1596401057633-565652b8ddbe?auto=format&fit=crop&w=1920&q=80';"
                 alt="Destinations Background" 
                 class="w-full h-full object-cover object-center opacity-40 animate-float-slow">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-3xl animate-fade-up text-center mx-auto md:text-left md:mx-0">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block">Where to Next?</span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-serif">Explore Our <br><span class="italic text-secondary">Destinations</span></h1>
                <p class="text-lg text-white/80 leading-relaxed font-light">
                    Discover handcrafted travel packages filled with adventure, culture, and unforgettable moments. 
                    From serene beaches to mountain treks, we’ve got your next journey covered.
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-20 bg-surface -mt-10 relative z-20 rounded-t-[3rem]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            @foreach ($destinations as $destination)
                <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-fade-up h-full flex flex-col group border border-gray-100">
                    <div class="relative h-56 overflow-hidden">
                        <img loading="lazy" src="{{ asset($destination->destination_photo) }}"
                            alt="{{ $destination->name_package }}"
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1000';"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                        
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-primary shadow-sm">
                            IDR {{ number_format($destination->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-primary mb-3 font-serif group-hover:text-secondary transition-colors">{{ $destination->name_package }}</h3>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach(array_slice(explode(',', $destination->activities), 0, 2) as $activity)
                                @if(trim($activity))
                                    <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide border border-gray-200">
                                        {{ trim($activity) }}
                                    </span>
                                @endif
                            @endforeach

                            @if(count(explode(',', $destination->activities)) > 2)
                                <span class="text-gray-400 text-xs flex items-center">+More</span>
                            @endif
                        </div>

                        <a href="{{ route('destination.show', $destination->slug) }}"
                            class="w-full mt-auto py-3 rounded-xl font-bold text-sm transition-all duration-300 flex items-center justify-center border-2 border-primary text-primary group-hover:bg-primary group-hover:text-white group-hover:border-transparent">
                            View Details <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            <div class="bg-primary rounded-[2rem] shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 animate-fade-up cursor-pointer group relative flex flex-col justify-center items-center text-center p-8 border border-white/10"
                 onclick="window.location='{{ route('booking.custom') }}'">
                
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-secondary/20 transition-colors"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -ml-16 -mb-16 group-hover:bg-secondary/20 transition-colors"></div>

                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-magic text-3xl text-secondary"></i>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white mb-3 font-serif">Design Your <br> Trip</h3>
                    <p class="text-white/70 text-sm mb-8 leading-relaxed font-light">
                        No package fits? Tell us your dream destination and we'll create a custom experience.
                    </p>

                    <button class="px-8 py-3 bg-secondary text-white rounded-full font-bold text-sm hover:bg-white hover:text-primary transition-all duration-300 shadow-lg shadow-secondary/30">
                        Customize Now <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <a href="https://wa.me/6281217006076?text=Hello%20GOING%20TO%20THE%20JAVA!%20I%20have%20a%20question..." 
       target="_blank"
       class="fixed bottom-8 right-8 z-50 flex items-center gap-3 bg-[#25D366] text-white px-5 py-3 rounded-full shadow-2xl hover:bg-[#20bd5a] hover:scale-105 transition-all duration-300 animate-bounce group">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-bold whitespace-nowrap hidden group-hover:block transition-all">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    @endpush
@endsection