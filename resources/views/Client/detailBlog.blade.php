@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
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

        /* Animation */
        .animate-fade-up {
            opacity: 0; transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        /* Components */
        .btn-premium {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
        }
        .btn-premium:hover { box-shadow: 0 10px 25px -5px rgba(0, 51, 102, 0.4); transform: translateY(-2px); }

        /* --- Blog Content Styling (Typography for Dynamic Content) --- */
        .blog-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--color-text);
        }
        .blog-content p { margin-bottom: 1.5rem; }
        .blog-content h2 { 
            font-family: 'Poppins', sans-serif; 
            font-size: 1.75rem; 
            font-weight: 700; 
            color: var(--color-primary); 
            margin-top: 2.5rem; 
            margin-bottom: 1rem; 
        }
        .blog-content h3 { 
            font-family: 'Poppins', sans-serif; 
            font-size: 1.4rem; 
            font-weight: 600; 
            color: var(--color-primary); 
            margin-top: 2rem; 
            margin-bottom: 0.75rem; 
        }
        .blog-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem; color: var(--color-text-light); }
        .blog-content ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; color: var(--color-text-light); }
        .blog-content li { margin-bottom: 0.5rem; }
        .blog-content blockquote {
            border-left: 4px solid var(--color-secondary);
            padding-left: 1.5rem;
            font-style: italic;
            color: var(--color-text-light);
            background: rgba(0, 180, 216, 0.05);
            padding: 1.5rem;
            border-radius: 0 1rem 1rem 0;
            margin-bottom: 1.5rem;
        }
        .blog-content img {
            border-radius: 1.5rem;
            margin: 2rem 0;
            width: 100%;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1);
        }
        .blog-content a { color: var(--color-secondary); text-decoration: none; font-weight: 600; transition: 0.3s; }
        .blog-content a:hover { text-decoration: underline; color: var(--color-primary); }
        .blog-content strong { color: var(--color-primary); font-weight: 700; }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HERO SECTION --}}
    <section class="relative h-[60vh] min-h-[500px] flex items-end pb-20 overflow-hidden bg-primary">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset($blog->image_path) }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=1920';"
                 alt="{{ $blog->title }}"
                 class="w-full h-full object-cover object-center opacity-60 scale-105 animate-[pulse_20s_ease-in-out_infinite]">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366] via-[#003366]/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl animate-fade-up">
                <div class="flex flex-wrap items-center gap-4 text-white/90 text-sm font-medium mb-6 uppercase tracking-wider">
                    <span class="bg-secondary text-white px-4 py-1.5 rounded-full font-bold shadow-lg shadow-secondary/30">
                        {{ $blog->category ?? 'Travel' }}
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="far fa-calendar"></i> {{ $blog->created_at->format('d M Y') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="far fa-clock"></i> {{ $blog->time_read ?? '5' }} min read
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white font-serif leading-tight mb-6 text-shadow-lg drop-shadow-md">
                    {{ $blog->title }}
                </h1>

                <nav class="flex text-white/70 text-sm font-medium">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('index') }}" class="hover:text-secondary transition">Home</a></li>
                        <li>/</li>
                        <li><a href="{{ route('blogs.index') }}" class="hover:text-secondary transition">Blog</a></li>
                        <li>/</li>
                        <li class="text-white font-bold truncate max-w-[200px]">{{ $blog->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="max-w-7xl mx-auto px-6 py-16 relative">
        {{-- Background Blobs --}}


        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 relative z-10">
            
            {{-- Main Article --}}
            <div class="lg:col-span-8">
                <article class="bg-white p-8 md:p-12 rounded-[2rem] shadow-xl border border-white/60 animate-fade-up">
                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-gray-500 font-serif italic">Share this story:</p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-500 hover:bg-sky-500 hover:text-white transition-all"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 hover:bg-green-500 hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-4 space-y-8">
                
                {{-- Author Card --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-white/60 animate-fade-up" style="animation-delay: 0.2s">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary text-2xl border border-primary/20">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 uppercase tracking-widest font-bold">Written By</span>
                            <h4 class="font-serif font-bold text-lg text-primary">Going To The Java Team</h4>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Sharing stories, tips, and hidden gems from our journeys across the beautiful island of Java and beyond.
                    </p>
                </div>

                {{-- Recent Posts --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-white/60 animate-fade-up" style="animation-delay: 0.3s">
                    <h3 class="font-serif font-bold text-xl text-primary mb-6 pb-2 border-b border-gray-100">Recent Posts</h3>
                    <div class="space-y-6">
                        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                            @foreach($relatedPosts as $recent)
                            <a href="{{ route('blogs.detail', $recent->title) }}" class="flex gap-4 group">
                                <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 relative">
                                    <img src="{{ asset($recent->image_path) }}" 
                                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=200';"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-secondary uppercase tracking-wider mb-1 block">{{ $recent->category }}</span>
                                    <h4 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                        {{ $recent->title }}
                                    </h4>
                                    <span class="text-xs text-gray-400 mt-2 block">{{ $recent->created_at->format('M d, Y') }}</span>
                                </div>
                            </a>
                            @endforeach
                        @else
                            <p class="text-gray-400 text-sm italic">No recent posts available.</p>
                        @endif
                    </div>
                </div>

                {{-- CTA Card --}}
                <div class="bg-primary rounded-[2rem] p-8 text-center text-white relative overflow-hidden animate-fade-up shadow-2xl" style="animation-delay: 0.4s">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-md">
                            <i class="fas fa-plane-departure text-2xl text-secondary"></i>
                        </div>
                        <h3 class="font-serif font-bold text-2xl mb-2">Inspired to Travel?</h3>
                        <p class="text-white/80 text-sm mb-6">Let us help you plan your perfect trip to these amazing destinations.</p>
                        <a href="{{ route('booking.custom') }}" class="inline-block w-full py-3 bg-white text-primary font-bold rounded-xl hover:bg-white transition-colors shadow-lg">
                            Plan My Trip
                        </a>
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
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    @endpush
@endsection