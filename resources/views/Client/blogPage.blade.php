@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- UNIFIED FONT TO POPPINS ONLY --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
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

        /* Components */
        .btn-premium {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
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

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(0, 51, 102, 0.08);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HERO SECTION --}}
    <section id="jumbotron" class="relative bg-primary min-h-[45vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/bg_header_blogs.jpeg') }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=1920';"
                 alt="Blog Header" 
                 class="w-full h-full object-cover object-center animate-float-slow"
                 style="opacity: 0.5;">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 via-[#003366]/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20 text-center">
            <div class="max-w-3xl mx-auto animate-fade-up">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block shadow-secondary/20">
                    @translate('Jurnal Perjalanan')
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 font-serif">
                    @translate('Cerita &') <span class="italic text-secondary">@translate('Inspirasi')</span>
                </h1>
                <p class="text-lg text-white/80 leading-relaxed font-light mb-8">
                    @translate('Temukan permata tersembunyi, tips perjalanan, dan wawasan budaya dari petualangan kami di seluruh Jawa dan sekitarnya.')
                </p>
            </div>
        </div>
    </section>

    {{-- SEARCH BAR SECTION --}}
    <section class="relative z-20 -mt-10 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="glass-card rounded-[2rem] p-6 shadow-xl animate-fade-up" style="animation-delay: 0.2s">
                <form action="{{ route('blogs.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        {{-- Placeholder perlu diterjemahkan manual di PHP --}}
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="<?php echo \App\Helpers\TranslationHelper::translate('Cari artikel, panduan...'); ?>" 
                            class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-secondary/30 focus:border-secondary outline-none transition-all placeholder-gray-400">
                    </div>

                    <div class="w-full md:w-64 relative">
                        <select name="category" onchange="this.form.submit()"
                            class="w-full pl-12 pr-10 py-4 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-secondary/30 focus:border-secondary outline-none transition-all appearance-none cursor-pointer text-gray-600">
                            <option value="">@translate('Semua Kategori')</option>
                            <option value="Tips" {{ request('category') == 'Tips' ? 'selected' : '' }}>@translate('Tips & Trik')</option>
                            <option value="Destinations" {{ request('category') == 'Destinations' ? 'selected' : '' }}>@translate('Destinasi')</option>
                            <option value="Culture" {{ request('category') == 'Culture' ? 'selected' : '' }}>@translate('Budaya')</option>
                            <option value="Food" {{ request('category') == 'Food' ? 'selected' : '' }}>@translate('Makanan & Kuliner')</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-premium px-8 py-4 rounded-xl font-bold shadow-lg flex items-center justify-center gap-2 group">
                        @translate('Cari') <i class="fas fa-search group-hover:scale-110 transition-transform"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- BLOG LIST SECTION --}}
    <section class="max-w-7xl mx-auto px-6 py-20 relative">
        
        @if(request('search') || request('category'))
            <div class="mb-8 animate-fade-up text-center relative z-10">
                <p class="text-gray-500">
                    @translate('Ditemukan') <span class="font-bold text-primary">{{ $blogs->total() }}</span> @translate('artikel')
                    @if(request('search')) @translate('untuk') "<span class="text-primary">{{ request('search') }}</span>" @endif
                    @if(request('category')) @translate('di') <span class="text-primary">{{ request('category') }}</span> @endif
                </p>
                <a href="{{ route('blogs.index') }}" class="text-sm text-secondary font-bold hover:underline mt-2 inline-block">@translate('Hapus Filter')</a>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10">
            @forelse ($blogs as $blog)
                <article class="bg-white rounded-[2rem] shadow-lg shadow-blue-900/5 border border-white/60 overflow-hidden group hover:shadow-xl hover:border-secondary/30 transition-all duration-300 animate-fade-up h-full flex flex-col">
                    
                    <div class="relative h-64 overflow-hidden">
                        <img loading="lazy" src="{{ asset($blog->image_path) }}" 
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=800';"
                             alt="{{ $blog->title }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/60 to-transparent opacity-60"></div>
                        
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-primary tracking-wide shadow-sm uppercase">
                            @translate($blog->category ?? 'Wisata')
                        </span>
                    </div>

                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-4 text-xs text-gray-400 font-bold uppercase tracking-widest mb-4">
                            <span class="flex items-center gap-1.5"><i class="far fa-calendar"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                            <span class="w-1 h-1 bg-secondary rounded-full"></span>
                            <span class="flex items-center gap-1.5"><i class="far fa-clock"></i> {{ $blog->time_read ?? '5' }} @translate('menit baca')</span>
                        </div>

                        <h3 class="text-2xl font-serif font-bold text-primary mb-3 leading-tight group-hover:text-secondary transition-colors line-clamp-2">
                            <a href="{{ route('blogs.detail', $blog->title) }}">
                                @translate($blog->title)
                            </a>
                        </h3>
                        
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                            {{-- Konten dibungkus translate, ini akan otomatis mendeteksi jika konten di DB bahasa Inggris/Indo --}}
                            @translate(Str::limit(strip_tags($blog->content), 120))
                        </p>

                        <div class="pt-6 border-t border-gray-100 mt-auto">
                            <a href="{{ route('blogs.detail', $blog->title) }}" class="inline-flex items-center text-sm font-bold text-primary group-hover:translate-x-2 transition-transform hover:text-secondary">
                                @translate('Baca Selengkapnya') <i class="fas fa-arrow-right ml-2 text-xs text-secondary"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-20 text-center animate-fade-up">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                        <i class="far fa-newspaper text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-gray-800 mb-2">@translate('Tidak ada artikel ditemukan')</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-8">@translate("Kami tidak dapat menemukan artikel yang cocok dengan kriteria Anda. Coba kata kunci lain atau jelajahi semua kategori.")</p>
                    <a href="{{ route('blogs.index') }}" class="btn-premium px-8 py-3 rounded-xl font-bold inline-block shadow-lg">
                        @translate('Lihat Semua Artikel')
                    </a>
                </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
            <div class="mt-16 animate-fade-up">
                {{ $blogs->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </section>

    {{-- BOTTOM SECTION (Recent & CTA) --}}
    <section class="max-w-7xl mx-auto px-6 pb-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                <div class="bg-white p-8 rounded-[2rem] shadow-lg shadow-blue-900/5 border border-white/60 animate-fade-up">
                    <h3 class="font-serif font-bold text-xl text-primary mb-6 pb-2 border-b border-gray-100">@translate('Update Terbaru')</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($recentPosts as $recent)
                        <a href="{{ route('blogs.detail', $recent->title) }}" class="flex gap-4 group p-4 rounded-xl hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100">
                            <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 relative">
                                <img src="{{ asset($recent->image_path) }}" 
                                     onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=200';"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-secondary uppercase tracking-wider mb-1 block">
                                    @translate($recent->category)
                                </span>
                                <h4 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                    @translate($recent->title)
                                </h4>
                                <span class="text-xs text-gray-400 mt-2 block">{{ $recent->created_at->format('M d, Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-primary rounded-[2rem] p-10 text-center text-white relative overflow-hidden animate-fade-up shadow-2xl h-full flex flex-col justify-center">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    
                    {{-- Glow Effect --}}
                    <div class="absolute -top-20 -right-20 w-60 h-60 bg-secondary/20 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-md border border-white/20">
                            <i class="fas fa-plane-departure text-3xl text-secondary"></i>
                        </div>
                        <h2 class="text-3xl font-serif font-bold mb-4">@translate('Terinspirasi untuk Bepergian?')</h2>
                        <p class="text-white/80 mb-8 font-light">
                            @translate('Mulai rencanakan perjalanan impian Anda bersama kami hari ini. Kami membuat rencana perjalanan khusus yang disesuaikan dengan preferensi Anda.')
                        </p>
                        <a href="{{ route('booking.custom') }}" class="inline-block w-full py-4 bg-white text-primary font-bold rounded-xl hover:bg-white transition-all shadow-lg transform hover:-translate-y-1">
                            @translate('Rencanakan Perjalanan Saya')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Floating WhatsApp (KEPT GREEN) --}}
    <a 
        href="https://api.whatsapp.com/send?phone=6281220005276&text=Halo%20Admin%20GOING%20TO%20THE%20JAVA%2C%20saya%20mau%20tanya%20tentang%20paket%20wisata.%20Boleh%20dibantu%3F"
        target="_blank"
        rel="noopener noreferrer"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group animate-bounce-slow"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium whitespace-nowrap">@translate('Butuh Bantuan?')</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    @endpush
@endsection