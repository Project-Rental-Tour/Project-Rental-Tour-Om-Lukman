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

        /* Glass Card */
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
    <section class="relative bg-primary h-[500px] flex items-center" id="jumbotron">
        <div class="absolute inset-0 z-0">
            <img loading="lazy" src="{{ asset($car->image_car_1) }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1494905998402-395d579af36f?q=80&w=1920';"
                 alt="{{ $car->name_car }}"
                 class="w-full h-full object-cover object-center animate-float-slow"
                 style="opacity: 0.6;">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 via-[#003366]/30 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-4xl animate-fade-up">
                <span class="bg-secondary text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider mb-4 inline-block shadow-lg shadow-secondary/30">
                    {{ ucfirst($car->car_type ?? 'General') }} Car
                </span>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 font-serif leading-tight text-shadow-lg drop-shadow-md">
                    {{ $car->name_car }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-6 text-white/90 text-lg font-light">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-users text-secondary"></i> {{ $car->capacity }} Seats
                    </span>
                    <span class="hidden md:inline">•</span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-cog text-secondary"></i> {{ ucfirst($car->transmission) }}
                    </span>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-xl border border-white/20 hover:bg-white/20 transition-colors">
                        <p class="text-xs text-white/70 uppercase font-bold tracking-wider mb-1">Daily Rate</p>
                        <p class="text-2xl font-bold text-white">Rp{{ number_format($car->price, 0, ',', '.') }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-lg text-sm font-bold uppercase tracking-wider
                        {{ $car->car_status == 'available' ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-red-500/20 text-red-300 border border-red-500/30' }}">
                        {{ ucfirst($car->car_status) }}
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
                <li><a href="{{route('usercar.index')}}" class="hover:text-primary transition-colors font-medium">Cars</a></li>
                <li>/</li>
                <li class="font-bold text-primary">{{ $car->name_car }}</li>
            </ol>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <section class="container mx-auto px-6 py-12 relative">
        {{-- Background Blobs --}}


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 relative z-10">
            
            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-2 space-y-12">
                
                {{-- Carousel Gallery --}}
                <div class="bg-white p-2 rounded-[2.5rem] shadow-xl border border-gray-100 animate-fade-up">
                    <div id="default-carousel" class="relative w-full h-[400px] rounded-[2rem] overflow-hidden group" data-carousel="static">
                        <div class="relative h-full overflow-hidden rounded-[2rem]">
                            @if($car->image_car_1)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <img src="{{ asset($car->image_car_1) }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                                </div>
                            @endif
                            @if($car->image_car_2)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <img src="{{ asset($car->image_car_2) }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                                </div>
                            @endif
                            @if($car->image_car_3)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <img src="{{ asset($car->image_car_3) }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                                </div>
                            @endif
                        </div>

                        {{-- Carousel Arrows --}}
                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/30 backdrop-blur-sm group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none transition-all">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/30 backdrop-blur-sm group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none transition-all">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>

                {{-- Information Tabs --}}
                <div class="glass-card rounded-[2rem] shadow-xl shadow-blue-900/5 overflow-hidden animate-fade-up" style="animation-delay: 0.2s">
                    <div class="px-6 pt-6 border-b border-gray-100 overflow-x-auto">
                        <ul class="flex flex-nowrap md:flex-wrap gap-2 pb-4 md:pb-0" role="tablist">
                            @foreach(['details' => 'Overview', 'specifications' => 'Specs', 'features' => 'Features', 'notes' => 'Important Notes'] as $key => $label)
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
                            <h3 class="text-2xl font-serif font-bold text-primary mb-4">Car Overview</h3>
                            <p class="text-gray-600 leading-relaxed mb-8">{{ $car->description }}</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-secondary/30 transition-colors">
                                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Rental Type</h4>
                                    <p class="font-semibold text-gray-800">{{ $car->rental_type ? 'With Driver' : 'Self Drive' }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-secondary/30 transition-colors">
                                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Capacity</h4>
                                    <p class="font-semibold text-gray-800">{{ $car->capacity }} Passengers</p>
                                </div>
                            </div>
                        </div>

                        {{-- Specs --}}
                        <div class="hidden animate-fade-in" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">Technical Specifications</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                                        <span class="text-gray-600">Transmission</span>
                                        <span class="font-bold text-primary">{{ ucfirst($car->transmission) }}</span>
                                    </div>
                                    <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                                        <span class="text-gray-600">Car Type</span>
                                        <span class="font-bold text-primary">{{ $car->car_type ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                                        <span class="text-gray-600">Status</span>
                                        <span class="font-bold {{ $car->car_status == 'available' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($car->car_status) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Features --}}
                        <div class="hidden animate-fade-in" id="features" role="tabpanel" aria-labelledby="features-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">Features & Amenities</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="font-bold text-primary mb-4 flex items-center gap-2 bg-green-50 p-3 rounded-lg border border-green-100">
                                        <i class="fas fa-check text-green-600"></i> Included Features
                                    </h4>
                                    <ul class="space-y-2">
                                        @foreach(explode(',', $car->include) as $item)
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
                                    <h4 class="font-bold text-blue-700 mb-4 flex items-center gap-2 bg-blue-50 p-3 rounded-lg border border-blue-100">
                                        <i class="fas fa-plus text-blue-600"></i> Additional Info
                                    </h4>
                                    <p class="text-gray-500 text-sm">Contact us for specific feature requests like child seats or roof racks.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="hidden animate-fade-in" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">Important Notes</h3>
                            <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl">
                                <ul class="space-y-3">
                                    @foreach(explode("\n", $car->notes) as $line)
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
            </div>

            {{-- RIGHT COLUMN (Sticky Booking Card) --}}
            <div class="lg:col-span-1">
                <div class="glass-card p-8 rounded-[2.5rem] shadow-2xl sticky top-28 animate-fade-up border border-white/60" style="animation-delay: 0.3s">
                    <div class="text-center mb-8">
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Daily Rate</p>
                        <div class="text-3xl md:text-4xl font-bold text-primary font-serif">
                            Rp{{ number_format($car->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('booking-car.form', $car->slug) }}"
                            class="btn-premium w-full py-4 rounded-xl font-bold text-lg shadow-lg flex items-center justify-center gap-2 group">
                            Book Now <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="https://wa.me/6281217006076?text=Hi%20GOING%20TO%20THE%20JAVA,%20I'm%20interested%20in%20renting%20{{ $car->name_car }}" 
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
                            <span>Well Maintained</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary"><i class="fas fa-check text-xs"></i></div>
                            <span>24/7 Roadside Assist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FAQ Section --}}
        <div class="glass-card p-8 rounded-[2rem] shadow-lg border border-white/60 mt-12 animate-fade-up relative z-10" style="animation-delay: 0.4s">
            <h3 class="text-2xl font-serif font-bold text-primary mb-8 text-center">Rental FAQ</h3>
            <div class="space-y-4 max-w-3xl mx-auto" id="accordion-open" data-accordion="open">
                @foreach([
                    'What documents are required?' => 'For self-drive: Driver license, ID/Passport, Credit Card deposit. With driver: Only ID/Passport.',
                    'Is fuel included?' => 'Self-drive: No, return with same fuel level. With driver: Yes, included.',
                    'Cancellation Policy?' => 'Free cancellation up to 48 hours before pickup.',
                    'Emergency Contact?' => 'Contact our 24/7 hotline provided in your booking confirmation.'
                ] as $q => $a)
                <div class="border border-white/50 bg-white/50 rounded-xl overflow-hidden" data-accordion-item>
                    <h2 id="accordion-heading-{{ $loop->index }}">
                        <button type="button" class="flex items-center justify-between w-full p-5 text-left font-bold text-gray-800 bg-white/50 hover:bg-primary/5 transition-colors focus:outline-none" data-accordion-target="#accordion-body-{{ $loop->index }}" aria-expanded="false" aria-controls="accordion-body-{{ $loop->index }}">
                            <span>{{ $q }}</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-gray-500 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-body-{{ $loop->index }}" class="hidden" aria-labelledby="accordion-heading-{{ $loop->index }}">
                        <div class="p-5 bg-white text-gray-600 text-sm leading-relaxed border-t border-gray-100">
                            {{ $a }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA Banner --}}
        <div class="mt-16 bg-primary rounded-[2rem] p-10 md:p-12 text-center md:text-left flex flex-col md:flex-row items-center justify-between shadow-2xl relative overflow-hidden animate-fade-up z-10">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="relative z-10 mb-6 md:mb-0">
                <h3 class="text-3xl font-bold text-white font-serif mb-2">Ready to hit the road?</h3>
                <p class="text-white/80">Book your perfect car now and enjoy a seamless journey.</p>
            </div>
            <div class="relative z-10">
                <a href="{{ route('booking-car.form', $car->slug) }}"
                    class="inline-flex items-center px-8 py-4 bg-secondary text-primary font-bold rounded-xl hover:bg-white transition-all shadow-lg">
                    Rent This Car <i class="fas fa-key ml-2"></i>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('[role="tab"]');
            const contents = document.querySelectorAll('[role="tabpanel"]');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.setAttribute('aria-selected', 'false'));
                    contents.forEach(c => {
                        c.classList.add('hidden');
                        c.classList.remove('animate-fade-in');
                    });

                    tab.setAttribute('aria-selected', 'true');
                    const target = document.querySelector(tab.dataset.tabsTarget);
                    target.classList.remove('hidden');
                    setTimeout(() => target.classList.add('animate-fade-in'), 10);
                });
            });
        });
    </script>
@endsection