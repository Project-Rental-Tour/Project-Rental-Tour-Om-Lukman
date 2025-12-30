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

        /* Masonry Fix */
        .columns-2 img, .columns-4 img {
            height: auto;
            display: block;
        }

        /* Animations */
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
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HEADER SECTION --}}
    <section id="jumbotron" class="relative bg-primary min-h-[50vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/bg_header_gallery.png') }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1920&q=80';"
                 alt="Gallery Header" 
                 class="w-full h-full object-cover object-center animate-float-slow"
                 style="opacity: 0.5;">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 via-[#003366]/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-3xl animate-fade-up text-center mx-auto md:text-left md:mx-0">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block shadow-secondary/20 drop-shadow-sm">Visual Diary</span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 font-serif leading-tight">Our Travel <span class="italic text-secondary">Gallery</span></h1>
                <p class="text-lg text-white/80 leading-relaxed font-light">
                    Every photo tells a story. Explore breathtaking moments from our journeys around the world — 
                    from hidden villages to majestic landscapes and joyful traveler experiences.
                </p>
            </div>
        </div>
    </section>
    
    {{-- GALLERY GRID SECTION --}}
    <section class="max-w-7xl mx-auto px-6 py-20 relative">
        {{-- Background Blobs --}}
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-[#00b4d8]/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#003366]/5 rounded-full blur-[100px] pointer-events-none"></div>
        
        <div class="relative z-10 columns-1 md:columns-2 lg:columns-4 gap-6 space-y-6">
            @forelse ($galleries as $index => $gallery)
                <div class="relative break-inside-avoid group rounded-2xl overflow-hidden shadow-lg animate-fade-up cursor-pointer" style="animation-delay: {{ $index * 0.05 }}s">
                    <img loading="lazy" 
                        src="{{ asset($gallery->gallery_photo) }}" 
                        alt="{{ $gallery->title }}"
                        onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80';"
                        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    
                    {{-- Overlay Gradient on Hover --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <span class="text-secondary text-xs font-bold uppercase tracking-wider mb-1">Moment</span>
                        <h3 class="text-white font-serif text-lg md:text-xl font-bold leading-tight">{{ $gallery->title }}</h3>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="far fa-images text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-lg font-serif">No gallery items available at the moment.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-16 animate-fade-up">
            <p class="text-gray-500 text-sm mb-4">Follow us on Instagram for more visual stories</p>
            <a href="#" class="inline-flex items-center gap-2 text-primary font-bold border-b-2 border-secondary/20 hover:border-secondary hover:text-secondary pb-1 transition-all">
                <i class="fab fa-instagram"></i> @goingtothejava
            </a>
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
        <span class="whatsapp-text font-medium whitespace-nowrap">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
    @endpush
@endsection