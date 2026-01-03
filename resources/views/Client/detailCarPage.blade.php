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
        
        /* Swiper Custom Pagination */
        .swiper-pagination-bullet {
            background: white;
            opacity: 0.5;
            width: 10px;
            height: 10px;
        }
        .swiper-pagination-bullet-active {
            background: var(--color-secondary);
            opacity: 1;
            width: 24px;
            border-radius: 6px;
            transition: all 0.3s;
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
                    {{-- Default fallback jadi 'Umum' --}}
                    @translate(ucfirst($car->car_type ?? 'Umum')) @translate('Mobil')
                </span>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 font-serif leading-tight text-shadow-lg drop-shadow-md">
                    {{ $car->name_car }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-6 text-white/90 text-lg font-light">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-users text-secondary"></i> {{ $car->capacity }} @translate('Kursi')
                    </span>
                    <span class="hidden md:inline">•</span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-cog text-secondary"></i> @translate(ucfirst($car->transmission))
                    </span>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-xl border border-white/20 hover:bg-white/20 transition-colors">
                        <p class="text-xs text-white/70 uppercase font-bold tracking-wider mb-1">@translate('Harga Per Hari')</p>
                        <p class="text-2xl font-bold text-white">
                            @currency($car->price)
                        </p>
                    </div>
                    {{-- Status biasanya 'available' di DB. Helper translate akan menanganinya (available -> tersedia) --}}
                    <span class="px-4 py-2 rounded-lg text-sm font-bold uppercase tracking-wider
                        {{ $car->car_status == 'available' ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-red-500/20 text-red-300 border border-red-500/30' }}">
                        @translate(ucfirst($car->car_status))
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- BREADCRUMBS --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 py-4 sticky top-16 z-30 shadow-sm">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-500">
                <li><a href="{{route('index')}}" class="hover:text-primary transition-colors font-medium">@translate('Beranda')</a></li>
                <li>/</li>
                <li><a href="{{route('usercar.index')}}" class="hover:text-primary transition-colors font-medium">@translate('Mobil')</a></li>
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
                
                {{-- Carousel Gallery (UPDATED TO SWIPER) --}}
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 animate-fade-up">
                    <div class="swiper main-car-swiper w-full h-[400px] rounded-[2rem] overflow-hidden relative group">
                        <div class="swiper-wrapper">
                            @php
                                $galleryImages = [];
                                if($car->image_car_1) $galleryImages[] = $car->image_car_1;
                                if($car->image_car_2) $galleryImages[] = $car->image_car_2;
                                if($car->image_car_3) $galleryImages[] = $car->image_car_3;
                            @endphp

                            @if(count($galleryImages) > 0)
                                @foreach($galleryImages as $image)
                                    <div class="swiper-slide w-full h-full">
                                        <img src="{{ asset($image) }}" 
                                             class="w-full h-full object-cover object-center transform transition-transform duration-500 hover:scale-105" 
                                             alt="Car Image">
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide w-full h-full">
                                    <img src="https://images.unsplash.com/photo-1494905998402-395d579af36f?q=80&w=1920" 
                                         class="w-full h-full object-cover object-center" 
                                         alt="Placeholder">
                                </div>
                            @endif
                        </div>

                        <div class="swiper-button-next !text-white !w-12 !h-12 !bg-white/20 !backdrop-blur-md !rounded-full !shadow-lg hover:!bg-white/40 transition-all after:!text-lg after:!font-bold opacity-0 group-hover:opacity-100"></div>
                        <div class="swiper-button-prev !text-white !w-12 !h-12 !bg-white/20 !backdrop-blur-md !rounded-full !shadow-lg hover:!bg-white/40 transition-all after:!text-lg after:!font-bold opacity-0 group-hover:opacity-100"></div>

                        <div class="swiper-pagination !bottom-6"></div>
                    </div>
                </div>

                {{-- Information Tabs --}}
                <div class="glass-card rounded-[2rem] shadow-xl shadow-blue-900/5 overflow-hidden animate-fade-up" style="animation-delay: 0.2s">
                    <div class="px-6 pt-6 border-b border-gray-100 overflow-x-auto">
                        <ul class="flex flex-nowrap md:flex-wrap gap-2 pb-4 md:pb-0" role="tablist">
                            {{-- Tab Headers dalam Bahasa Indonesia --}}
                            @foreach(['details' => 'Ringkasan', 'features' => 'Fitur', 'notes' => 'Catatan Penting'] as $key => $label)
                            <li class="flex-shrink-0" role="presentation">
                                <button
                                    id="{{ $key }}-tab"
                                    data-tabs-target="#{{ $key }}"
                                    type="button"
                                    role="tab"
                                    aria-controls="{{ $key }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                    class="tab-btn px-6 py-3 rounded-xl border text-sm font-bold transition-all duration-300">
                                    @translate($label)
                                </button>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div id="myTabContent" class="p-8">
                        {{-- Overview --}}
                        <div class="block animate-fade-in" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-4">@translate('Ringkasan Mobil')</h3>
                            <p class="text-gray-600 leading-relaxed mb-8">
                                {{-- Translate deskripsi dari DB jika masih Inggris --}}
                                @translate($car->description)
                            </p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <div class="flex items-center gap-2 mb-1 text-gray-400">
                                        <i class="fas fa-key text-xs"></i> <h4 class="text-xs font-bold uppercase tracking-wider">@translate('Tipe Sewa')</h4>
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm md:text-base">
                                        @translate($car->rental_type ? 'Dengan Supir' : 'Lepas Kunci')
                                    </p>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <div class="flex items-center gap-2 mb-1 text-gray-400">
                                        <i class="fas fa-users text-xs"></i> <h4 class="text-xs font-bold uppercase tracking-wider">@translate('Kapasitas')</h4>
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm md:text-base">{{ $car->capacity }} @translate('Penumpang')</p>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <div class="flex items-center gap-2 mb-1 text-gray-400">
                                        <i class="fas fa-cogs text-xs"></i> <h4 class="text-xs font-bold uppercase tracking-wider">@translate('Transmisi')</h4>
                                    </div>
                                    <p class="font-bold text-primary text-sm md:text-base">@translate(ucfirst($car->transmission))</p>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <div class="flex items-center gap-2 mb-1 text-gray-400">
                                        <i class="fas fa-car text-xs"></i> <h4 class="text-xs font-bold uppercase tracking-wider">@translate('Tipe Mobil')</h4>
                                    </div>
                                    <p class="font-bold text-primary text-sm md:text-base">@translate($car->car_type ?? '-')</p>
                                </div>

                                <div class="col-span-2 md:col-span-2 bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-gray-400">
                                        <i class="fas fa-info-circle text-xs"></i>
                                        <h4 class="text-xs font-bold uppercase tracking-wider">@translate('Status Ketersediaan')</h4>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $car->car_status == 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        @translate(ucfirst($car->car_status))
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Specs --}}
                        {{-- <div class="hidden animate-fade-in" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">@translate('Spesifikasi Teknis')</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                            </div>
                        </div> --}}

                        {{-- Features --}}
                        <div class="hidden animate-fade-in" id="features" role="tabpanel" aria-labelledby="features-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">@translate('Fitur & Fasilitas')</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h4 class="font-bold text-primary mb-4 flex items-center gap-2 bg-green-50 p-3 rounded-lg border border-green-100">
                                        <i class="fas fa-check text-green-600"></i> @translate('Fitur Termasuk')
                                    </h4>
                                    <ul class="space-y-2">
                                        @foreach(explode('.', $car->include) as $item)
                                            @if(trim($item))
                                                <li class="text-gray-600 flex items-start gap-2 text-sm">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-2 shrink-0"></span>
                                                    @translate(trim($item))
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-bold text-blue-700 mb-4 flex items-center gap-2 bg-blue-50 p-3 rounded-lg border border-blue-100">
                                        <i class="fas fa-plus text-blue-600"></i> @translate('Info Tambahan')
                                    </h4>
                                    <p class="text-gray-500 text-sm">@translate('Hubungi kami untuk permintaan fitur khusus seperti kursi bayi atau rak atap.')</p>
                                </div>
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="hidden animate-fade-in" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <h3 class="text-2xl font-serif font-bold text-primary mb-6">@translate('Catatan Penting')</h3>
                            <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl">
                                <ul class="space-y-3">
                                    @foreach(explode("\n", $car->notes) as $line)
                                        @if(trim($line))
                                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                                <i class="fas fa-info-circle text-secondary mt-0.5"></i>
                                                <span>{!! \App\Helpers\TranslationHelper::translate(trim($line)) !!}</span>
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
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">@translate('Harga Per Hari')</p>
                        <div class="text-3xl md:text-4xl font-bold text-primary font-serif">
                            @currency($car->price)
                        </div>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('booking-car.form', $car->slug) }}"
                            class="btn-premium w-full py-4 rounded-xl font-bold text-lg shadow-lg flex items-center justify-center gap-2 group">
                            @translate('Pesan Sekarang') <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="https://wa.me/6281220005276?text=Halo%20Admin%20GOING%20TO%20THE%20JAVA,%20Saya%20tertarik%20sewa%20mobil%20{{ $car->name_car }}" 
                           target="_blank"
                           class="w-full py-4 bg-white text-primary rounded-xl font-bold border border-primary/20 flex items-center justify-center gap-2 hover:bg-primary/5 transition-all">
                            <i class="fab fa-whatsapp text-xl"></i> @translate('Chat untuk Info')
                        </a>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-100 space-y-3">
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary"><i class="fas fa-check text-xs"></i></div>
                            <span>@translate('Konfirmasi Instan')</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary"><i class="fas fa-check text-xs"></i></div>
                            <span>@translate('Terawat Baik')</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600">
                            <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary"><i class="fas fa-check text-xs"></i></div>
                            <span>@translate('Bantuan Jalan 24/7')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FAQ Section (Indonesian Default) --}}
        <div class="glass-card p-8 rounded-[2rem] shadow-lg border border-white/60 mt-12 animate-fade-up relative z-10" style="animation-delay: 0.4s">
            <h3 class="text-2xl font-serif font-bold text-primary mb-8 text-center">@translate('FAQ Sewa')</h3>
            <div class="space-y-4 max-w-3xl mx-auto" id="accordion-open" data-accordion="open">
                @foreach([
                    'Dokumen apa yang diperlukan?' => 'Untuk lepas kunci: SIM, KTP/Paspor, Deposit Kartu Kredit. Dengan supir: Hanya KTP/Paspor.',
                    'Apakah BBM termasuk?' => 'Lepas kunci: Tidak, kembalikan dengan posisi BBM sama. Dengan supir: Ya, termasuk.',
                    'Kebijakan Pembatalan?' => 'Pembatalan gratis hingga 48 jam sebelum waktu penjemputan.',
                    'Kontak Darurat?' => 'Hubungi hotline 24/7 kami yang tertera pada konfirmasi pesanan Anda.'
                ] as $q => $a)
                <div class="border border-white/50 bg-white/50 rounded-xl overflow-hidden" data-accordion-item>
                    <h2 id="accordion-heading-{{ $loop->index }}">
                        <button type="button" class="flex items-center justify-between w-full p-5 text-left font-bold text-gray-800 bg-white/50 hover:bg-primary/5 transition-colors focus:outline-none" data-accordion-target="#accordion-body-{{ $loop->index }}" aria-expanded="false" aria-controls="accordion-body-{{ $loop->index }}">
                            <span>@translate($q)</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-gray-500 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-body-{{ $loop->index }}" class="hidden" aria-labelledby="accordion-heading-{{ $loop->index }}">
                        <div class="p-5 bg-white text-gray-600 text-sm leading-relaxed border-t border-gray-100">
                            @translate($a)
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
                <h3 class="text-3xl font-bold text-white font-serif mb-2">@translate('Siap untuk memulai perjalanan?')</h3>
                <p class="text-white/80">@translate('Pesan mobil impian Anda sekarang dan nikmati perjalanan yang lancar.')</p>
            </div>
            <div class="relative z-10">
                <a href="{{ route('booking-car.form', $car->slug) }}"
                    class="inline-flex items-center px-8 py-4 bg-white text-primary font-bold rounded-xl hover:bg-white transition-all shadow-lg">
                    @translate('Sewa Mobil Ini') <i class="fas fa-key ml-2"></i>
                </a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".main-car-swiper", {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                effect: "slide",
                speed: 600,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            // Manual Tab Logic (To prevent Flowbite/Tailwind conflict on animation)
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