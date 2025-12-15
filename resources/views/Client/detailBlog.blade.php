@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
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
            --color-secondary-light: #e0c09a;
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
        .btn-premium:hover { box-shadow: 0 10px 25px -5px rgba(10, 61, 38, 0.4); transform: translateY(-2px); }

        /* --- Blog Content Styling (Typography for Dynamic Content) --- */
        .blog-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #4b5563;
        }
        .blog-content p { margin-bottom: 1.5rem; }
        .blog-content h2 { 
            font-family: 'Playfair Display', serif; 
            font-size: 1.875rem; 
            font-weight: 700; 
            color: var(--color-primary); 
            margin-top: 2.5rem; 
            margin-bottom: 1rem; 
        }
        .blog-content h3 { 
            font-family: 'Playfair Display', serif; 
            font-size: 1.5rem; 
            font-weight: 600; 
            color: #1f2937; 
            margin-top: 2rem; 
            margin-bottom: 0.75rem; 
        }
        .blog-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem; }
        .blog-content ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; }
        .blog-content li { margin-bottom: 0.5rem; }
        .blog-content blockquote {
            border-left: 4px solid var(--color-secondary);
            padding-left: 1rem;
            font-style: italic;
            color: #4b5563;
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 0 0.5rem 0.5rem 0;
            margin-bottom: 1.5rem;
        }
        .blog-content img {
            border-radius: 1rem;
            margin: 2rem 0;
            width: 100%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .blog-content a { color: var(--color-primary); text-decoration: underline; }
        .blog-content strong { color: #111827; font-weight: 700; }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section class="relative h-[60vh] min-h-[500px] flex items-end pb-20 overflow-hidden bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset($blog->image_path) }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=1920';"
                 alt="{{ $blog->title }}"
                 class="w-full h-full object-cover object-center opacity-60 scale-105 animate-[pulse_20s_ease-in-out_infinite]">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl animate-fade-up">
                <div class="flex flex-wrap items-center gap-4 text-white/90 text-sm font-medium mb-6 uppercase tracking-wider">
                    <span class="bg-secondary text-primary px-3 py-1 rounded-full font-bold">
                        {{ $blog->category ?? 'Travel' }}
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="far fa-calendar"></i> {{ $blog->created_at->format('d M Y') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="far fa-clock"></i> {{ $blog->time_read ?? '5' }} min read
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white font-serif leading-tight mb-6 text-shadow-lg">
                    {{ $blog->title }}
                </h1>

                <nav class="flex text-white/70 text-sm">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('index') }}" class="hover:text-white transition">Home</a></li>
                        <li>/</li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white transition">Blog</a></li>
                        <li>/</li>
                        <li class="text-white font-semibold truncate max-w-[200px]">{{ $blog->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8">
                <article class="bg-white p-8 md:p-12 rounded-[2rem] shadow-xl border border-gray-100 animate-fade-up">
                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-gray-500 font-serif italic">Share this story:</p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-400 hover:text-white transition-all"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-green-500 hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </article>
            </div>

            <div class="lg:col-span-4 space-y-8">
                
                <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-gray-100 animate-fade-up" style="animation-delay: 0.2s">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary text-2xl">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 uppercase tracking-widest">Written By</span>
                            <h4 class="font-serif font-bold text-lg text-gray-900">Admin Going To The Java</h4>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Sharing stories, tips, and hidden gems from our journeys across the beautiful island of Java and beyond.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-gray-100 animate-fade-up" style="animation-delay: 0.3s">
                    <h3 class="font-serif font-bold text-xl text-primary mb-6 pb-2 border-b border-gray-100">Recent Posts</h3>
                    <div class="space-y-6">
                        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                            @foreach($relatedPosts as $recent)
                            {{-- Ganti parameter route ke title karena Anda menggunakan title di URL --}}
                            <a href="{{ route('blog.detail', $recent->title) }}" class="flex gap-4 group">
                                <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
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
                            <p class="text-gray-400 text-sm">No recent posts.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-primary rounded-[2rem] p-8 text-center text-white relative overflow-hidden animate-fade-up shadow-2xl" style="animation-delay: 0.4s">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    <div class="relative z-10">
                        <i class="fas fa-plane-departure text-4xl text-secondary mb-4"></i>
                        <h3 class="font-serif font-bold text-2xl mb-2">Inspired to Travel?</h3>
                        <p class="text-white/80 text-sm mb-6">Let us help you plan your perfect trip to these amazing destinations.</p>
                        <a href="{{ route('booking.custom') }}" class="inline-block w-full py-3 bg-secondary text-primary font-bold rounded-xl hover:bg-white transition-colors">
                            Plan My Trip
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <a href="https://wa.me/6281217006076?text=Hi%20Septem%20Tour!%20I'm%20reading%20about%20{{ $blog->title }}" 
       target="_blank"
       id="whatsapp-float"
       class="fixed bottom-8 right-8 z-50 flex items-center gap-3 bg-[#25D366] text-white px-5 py-3 rounded-full shadow-2xl hover:bg-[#20bd5a] hover:scale-105 transition-all duration-300 animate-bounce group">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-bold whitespace-nowrap hidden group-hover:block transition-all">Chat With Us</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    @endpush
@endsection