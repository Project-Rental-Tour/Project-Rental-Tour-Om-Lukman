@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* --- Premium Green Theme Configuration --- */
        :root {
            --color-primary: #0a3d26;   /* Deep Forest Green */
            --color-primary-light: #145a3a;
            --color-secondary: #cfa372; /* Luxury Gold */
            --color-surface: #fdfbf8;   /* Off-White/Paper */
            --color-text: #3d3d3d;
            --color-text-light: #7a7a7a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-surface);
            color: var(--color-text);
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.01em;
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

        /* Texture Pattern */
        .leaf-pattern {
            background-image: radial-gradient(#0a3d26 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            opacity: 0.05;
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section id="jumbotron" class="relative bg-primary min-h-[50vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/bg_header_gallery.png') }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1920&q=80';"
                 alt="Gallery Header" 
                 class="w-full h-full object-cover object-center opacity-40 animate-float-slow">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-3xl animate-fade-up text-center mx-auto md:text-left md:mx-0">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block">Visual Diary</span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 font-serif">Our Travel <span class="italic text-secondary">Gallery</span></h1>
                <p class="text-lg text-white/80 leading-relaxed font-light">
                    Every photo tells a story. Explore breathtaking moments from our journeys around the world — 
                    from hidden villages to majestic landscapes and joyful traveler experiences.
                </p>
            </div>
        </div>
    </section>
    
    <section class="max-w-7xl mx-auto px-6 py-20 bg-surface relative">
        <div class="absolute inset-0 leaf-pattern pointer-events-none"></div>
        
        <div class="relative z-10 columns-1 md:columns-2 lg:columns-4 gap-6 space-y-6">
            @forelse ($galleries as $index => $gallery)
                <div class="relative break-inside-avoid group rounded-2xl overflow-hidden shadow-lg animate-fade-up cursor-pointer" style="animation-delay: {{ $index * 0.05 }}s">
                    <img loading="lazy" 
                        src="{{ asset($gallery->gallery_photo) }}" 
                        alt="{{ $gallery->title }}"
                        onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80';"
                        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <span class="text-secondary text-xs font-bold uppercase tracking-wider mb-1">Moment</span>
                        <h3 class="text-white font-serif text-lg md:text-xl font-bold leading-tight">{{ $gallery->title }}</h3>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-400 text-lg font-serif italic">No gallery items available at the moment.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-16 animate-fade-up">
            <p class="text-gray-500 text-sm mb-4">Follow us on Instagram for more visual stories</p>
            <a href="#" class="inline-flex items-center gap-2 text-primary font-bold border-b-2 border-primary/20 hover:border-primary pb-1 transition-all">
                <i class="fab fa-instagram"></i> @goingtothejava
            </a>
        </div>
    </section>

    <a href="https://wa.me/6281217006076?text=Hi%20GOING%20TO%20THE%20JAVA..." 
       target="_blank"
       id="whatsapp-float"
       class="fixed bottom-8 right-8 z-50 flex items-center gap-3 bg-[#25D366] text-white px-5 py-3 rounded-full shadow-2xl hover:bg-[#20bd5a] hover:scale-105 transition-all duration-300 animate-bounce group">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-bold whitespace-nowrap hidden group-hover:block transition-all">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
    @endpush
@endsection