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

        /* Animations */
        .animate-fade-up {
            opacity: 0; transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        /* Tabs Styling */
        .tab-btn[aria-selected="true"] {
            background-color: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
            box-shadow: 0 4px 6px -1px rgba(0, 51, 102, 0.2);
        }
        .tab-btn[aria-selected="false"] {
            background-color: transparent;
            color: var(--color-text-light);
            border-color: #e2e8f0;
        }
        .tab-btn[aria-selected="false"]:hover {
            background-color: #f1f5f9;
            color: var(--color-primary);
            border-color: var(--color-primary);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HERO SECTION --}}
    <section class="relative bg-primary h-[500px] flex items-center" id="jumbotron">
        <div class="absolute inset-0 z-0">
            <img loading="lazy" src="{{ asset($destination->destination_photo_1) }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&q=80';"
                 alt="{{ $destination->name_package }}"
                 class="w-full h-full object-cover object-center"
                 style="opacity: 0.6;">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 via-[#003366]/30 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-4xl animate-fade-up">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="bg-secondary text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider shadow-lg shadow-secondary/30">
                        {{ ucfirst($destination->category) }} Trip
                    </span>
                    <span class="bg-white/20 backdrop-blur-md text-white border border-white/30 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                        {{ ucfirst($destination->level) }} Level
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 font-serif leading-tight text-shadow-lg drop-shadow-md">
                    {{ $destination->name_package }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-6 text-white/90 text-lg font-light">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-secondary"></i> {{ $destination->place }}
                    </span>
                    <span class="hidden md:inline">•</span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-clock text-secondary"></i> {{ $destination->time }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- BREADCRUMBS --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 py-4 sticky top-16 z-30 shadow-sm">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-500">
                <li><a href="{{route('index')}}" class="hover:text-primary transition-colors font-medium">Home</a></li>
                <li>/</li>
                <li><a href="{{route('destination.index')}}" class="hover:text-primary transition-colors font-medium">Destinations</a></li>
                <li>/</li>
                <li class="font-bold text-primary">{{ $destination->name_package }}</li>
            </ol>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <section class="container mx-auto px-6 py-12 relative">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            {{-- LEFT COLUMN (Details) --}}
            <div class="lg:col-span-2 space-y-12">
                
                {{-- Main Image --}}
                <div class="rounded-3xl overflow-hidden shadow-2xl shadow-blue-900/10 h-[400px] group animate-fade-up">
                    <img loading="lazy" src="{{ asset($destination->destination_photo_1) }}" 
                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&q=80';"
                         alt="Main View"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>

                {{-- Tabs Container --}}
                <div class="bg-white/80 backdrop-blur rounded-[2rem] shadow-xl shadow-blue-900/5 border border-white/60 overflow-hidden animate-fade-up" style="animation-delay: 0.2s">
                    <div class="px-6 pt-6 border-b border-gray-100 overflow-x-auto">
                        <ul class="flex flex-nowrap md:flex-wrap gap-2 pb-4 md:pb-0" role="tablist">
                            @foreach(['details' => 'Overview', 'tour' => 'Highlights', 'inclusion' => 'Facilities', 'itinerary' => 'Itinerary', 'note' => 'Notes'] as $key => $label)
                            <li class="flex-shrink-0" role="presentation">
                                <button
                                    id="{{ $key }}-tab"
                                    data-tabs-target="#{{ $key }}"
                                    type="button"
                                    role="tab"
                                    aria-controls="{{ $key }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                    class="tab-btn px-6 py-3 rounded-xl border text-sm font-bold transition-all duration-300">
                                    {{ $label }}
                                </button>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div id="myTabContent" class="p-8">
                        {{-- Overview --}}
                        <div class="block animate-fade-in" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-4">Trip Overview</h3>
                            <p class="text-gray-600 leading-relaxed mb-8">{{$destination->description}}</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach([
                                    ['Location', $destination->place, 'map-pin'],
                                    ['Duration', $destination->time, 'hourglass-half'],
                                    ['Transport', $destination->transportation, 'shuttle-van'],
                                    ['Stay', $destination->accommodation, 'bed'],
                                    ['Pickup', $destination->pickup_points, 'map-marker-alt'],
                                    ['Dropoff', $destination->dropoff_points, 'flag-checkered']
                                ] as $detail)
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-secondary/20 transition-colors">
                                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-{{ $detail[2] }}"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $detail[0] }}</h4>
                                        <p class="font-semibold text-gray-800">{{ $detail[1] }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Highlights --}}
                        <div class="hidden animate-fade-in" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">Tour Highlights</h3>
                            <ul class="space-y-3">
                                @foreach(explode(',', $destination->activities) as $item)
                                    @if(trim($item))
                                        <li class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-secondary/30 transition-colors">
                                            <i class="fas fa-check-circle text-secondary text-lg"></i>
                                            <span class="text-gray-700 font-medium">{{ trim($item) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        {{-- Inclusions --}}
                        <div class="hidden animate-fade-in" id="inclusion" role="tabpanel" aria-labelledby="inclusion-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">Inclusions & Exclusions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="font-bold text-primary mb-4 flex items-center gap-2 bg-green-50 p-3 rounded-lg border border-green-100">
                                        <i class="fas fa-check text-green-600"></i> What's Included
                                    </h4>
                                    <ul class="space-y-2 pl-2">
                                        @foreach(explode('.', $destination->include) as $item)
                                            @if(trim($item))
                                                <li class="text-gray-600 flex items-start gap-2 text-sm">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-2 shrink-0"></span>
                                                    {{ trim($item) }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div>
                                    <h4 class="font-bold text-red-700 mb-4 flex items-center gap-2 bg-red-50 p-3 rounded-lg border border-red-100">
                                        <i class="fas fa-times text-red-600"></i> Not Included
                                    </h4>
                                    <ul class="space-y-2 pl-2">
                                        @foreach(explode('.', $destination->exclude) as $item)
                                            @if(trim($item))
                                                <li class="text-gray-600 flex items-start gap-2 text-sm">
                                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mt-2 shrink-0"></span>
                                                    {{ trim($item) }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Itinerary --}}
                        <div class="hidden animate-fade-in" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">Itinerary</h3>
                            <div class="space-y-6 relative border-l-2 border-primary/20 ml-3 pl-8">
                                @php $lines = explode("\n", $destination->itinerary); @endphp
                                @foreach($lines as $line)
                                    @if(trim($line))
                                        <div class="relative">
                                            {{-- Dot with Secondary Color --}}
                                            <span class="absolute -left-[41px] top-1 w-6 h-6 rounded-full bg-secondary border-4 border-white flex items-center justify-center text-white text-[10px] shadow-sm">
                                                <i class="fas fa-circle text-[8px]"></i>
                                            </span>
                                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 hover:bg-white hover:shadow-md transition-all">
                                                <p class="text-gray-700 leading-relaxed text-sm">{!! trim($line) !!}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="hidden animate-fade-in" id="note" role="tabpanel" aria-labelledby="note-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">Important Notes</h3>
                            <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl">
                                <ul class="space-y-3">
                                    @foreach(explode("\n", $destination->note) as $line)
                                        @if(trim($line))
                                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                                <i class="fas fa-info-circle text-secondary mt-0.5"></i>
                                                <span>{!! trim($line) !!}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Related Photos --}}
                <div class="bg-white/80 backdrop-blur p-8 rounded-[2rem] shadow-lg border border-white/60 animate-fade-up" style="animation-delay: 0.3s">
                    <h3 class="text-2xl font-serif font-bold text-primary mb-6">More Photos</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse($relatedGalleries as $gallery)
                        <div class="group relative overflow-hidden rounded-xl h-32 md:h-40 cursor-pointer shadow-sm">
                            <img loading="lazy" src="{{ asset($gallery->gallery_photo) }}" 
                                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&q=80';"
                                 alt="{{ $gallery->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-xl"></i>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-400 col-span-4 text-center py-4 italic">No additional photos available.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN (Sticky Booking Card) --}}
            <div class="lg:col-span-1">
                <div class="glass-card p-8 rounded-[2.5rem] shadow-2xl sticky top-28 animate-fade-up border border-white/60" style="animation-delay: 0.4s">
                    <div class="text-center mb-8">
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Best Price Offer</p>
                        <div class="text-3xl md:text-4xl font-bold text-primary font-serif">
                            IDR {{ number_format($destination->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('booking.regular.form', $destination->slug) }}"
                            class="btn-premium w-full py-4 rounded-xl font-bold text-lg shadow-lg flex items-center justify-center gap-2 group">
                            Book Now <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="https://wa.me/6281217006076?text=Hi%20GOING%20TO%20THE%20JAVA,%20I'm%20interested%20in%20{{ $destination->name_package }}" 
                           target="_blank"
                           class="w-full py-4 bg-white text-primary rounded-xl font-bold border border-primary/20 flex items-center justify-center gap-2 hover:bg-primary/5 transition-all">
                            <i class="fab fa-whatsapp text-xl"></i> Chat for Info
                        </a>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-100 space-y-3">
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary"><i class="fas fa-check text-xs"></i></div>
                            <span>Instant Confirmation</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary"><i class="fas fa-check text-xs"></i></div>
                            <span>Professional Local Guide</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary"><i class="fas fa-check text-xs"></i></div>
                            <span>No Hidden Fees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA Banner --}}
        <div class="mt-16 bg-primary rounded-[2rem] p-10 md:p-12 text-center md:text-left flex flex-col md:flex-row items-center justify-between shadow-2xl relative overflow-hidden animate-fade-up">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            {{-- Decoration Circle --}}
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-secondary/20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 mb-6 md:mb-0">
                <h3 class="text-3xl font-bold text-white font-serif mb-2">Ready for Adventure?</h3>
                <p class="text-white/80">Don't let this experience slip away. Secure your spot today!</p>
            </div>
            <div class="relative z-10">
                <a href="{{ route('booking.regular.form', $destination->slug) }}"
                    class="inline-flex items-center px-8 py-4 bg-secondary text-white font-bold rounded-xl hover:bg-white hover:text-primary transition-all shadow-lg">
                    Book This Trip <i class="fas fa-paper-plane ml-2"></i>
                </a>
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
    <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('[role="tab"]');
            const contents = document.querySelectorAll('[role="tabpanel"]');

            function deactivateAll() {
                tabs.forEach(tab => {
                    tab.setAttribute('aria-selected', 'false');
                });
                contents.forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('animate-fade-in');
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    if (tab.getAttribute('aria-selected') === 'true') return;

                    deactivateAll();

                    // Activate clicked tab
                    tab.setAttribute('aria-selected', 'true');

                    // Show content
                    const target = document.querySelector(tab.dataset.tabsTarget);
                    target.classList.remove('hidden');
                    // Add small delay to trigger animation reset
                    setTimeout(() => {
                        target.classList.add('animate-fade-in');
                    }, 10);
                });
            });
        });
    </script>
@endsection