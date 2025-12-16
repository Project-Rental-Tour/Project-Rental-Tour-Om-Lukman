@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- UNIFIED FONT TO POPPINS ONLY --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

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
        .bg-primary { background-color: var(--color-primary) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }

        /* Animation */
        .animate-fade-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s ease-out forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Accordion Customization */
        [data-accordion-item] {
            border-color: rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
        }

        [data-accordion-item] button[aria-expanded="true"] {
            background-color: rgba(0, 51, 102, 0.05); /* Primary light bg */
            color: var(--color-primary);
        }
        
        [data-accordion-item] button:hover {
            background-color: rgba(0, 51, 102, 0.02);
            color: var(--color-primary);
        }

        /* Custom scrollbar for aesthetic */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--color-surface); }
        ::-webkit-scrollbar-thumb { background: var(--color-primary); border-radius: 4px; }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HEADER SECTION --}}
    <section class="max-w-4xl mx-auto px-6 py-24 text-center mt-0 relative z-10">
        <span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs mb-4 block animate-fade-up">Help Center</span>
        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-6 animate-fade-up font-serif" style="animation-delay: 0.1s">
            Frequently Asked Questions
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto animate-fade-up font-light leading-relaxed" style="animation-delay: 0.2s">
            Find answers to the most common questions about our travel packages, booking process, and what to expect on your journey with Going To The Java.
        </p>
    </section>

    {{-- ACCORDION SECTION --}}
    <section class="max-w-3xl mx-auto px-6 pb-32 relative">
        {{-- Background Blobs --}}
        <div class="absolute top-0 right-[-100px] w-[300px] h-[300px] bg-[#00b4d8]/10 rounded-full blur-[80px] pointer-events-none animate-pulse"></div>
        <div class="absolute bottom-0 left-[-100px] w-[300px] h-[300px] bg-[#003366]/5 rounded-full blur-[80px] pointer-events-none"></div>

        <div class="space-y-4 relative z-10" id="accordion-open" data-accordion="open">
            
            <div class="rounded-2xl shadow-sm border border-white/60 overflow-hidden animate-fade-up" style="animation-delay: 0.3s" data-accordion-item>
                <h2 id="accordion-heading-1">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-700 transition-all duration-300 focus:ring-0 focus:outline-none gap-4 hover:pl-7" data-accordion-target="#accordion-body-1" aria-expanded="true" aria-controls="accordion-body-1">
                        <span>Is it possible to pick up at the airport or train station?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-1" class="hidden" aria-labelledby="accordion-heading-1">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed text-sm md:text-base">
                        Yes. Please make sure the flight arrival is before 4:00 AM. If by train, 1 hour before pick up time is fine.
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow-sm border border-white/60 overflow-hidden animate-fade-up" style="animation-delay: 0.4s" data-accordion-item>
                <h2 id="accordion-heading-2">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-700 transition-all duration-300 focus:ring-0 focus:outline-none gap-4 hover:pl-7" data-accordion-target="#accordion-body-2" aria-expanded="false" aria-controls="accordion-body-2">
                        <span>Is it possible to be dropped off at the airport or train station?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-2" class="hidden" aria-labelledby="accordion-heading-2">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed text-sm md:text-base">
                        Yes, either Surabaya or Denpasar airport are possible. Please make sure the flight/train departure is 2 hours later than 5:00 PM (17:00) — a flight leaving around 19:00 should be fine. If taking a train to the west (e.g., Yogyakarta), we suggest Ketapang train station.
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow-sm border border-white/60 overflow-hidden animate-fade-up" style="animation-delay: 0.5s" data-accordion-item>
                <h2 id="accordion-heading-3">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-700 transition-all duration-300 focus:ring-0 focus:outline-none gap-4 hover:pl-7" data-accordion-target="#accordion-body-3" aria-expanded="false" aria-controls="accordion-body-3">
                        <span>Do I have to carry my luggage during the tour?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-3" class="hidden" aria-labelledby="accordion-heading-3">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed text-sm md:text-base">
                        Yes. But you will leave it in the car while you’re doing the activity. Our drivers will ensure your belongings are safe.
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow-sm border border-white/60 overflow-hidden animate-fade-up" style="animation-delay: 0.6s" data-accordion-item>
                <h2 id="accordion-heading-4">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-700 transition-all duration-300 focus:ring-0 focus:outline-none gap-4 hover:pl-7" data-accordion-target="#accordion-body-4" aria-expanded="false" aria-controls="accordion-body-4">
                        <span>Is it allowed to fly a drone?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-4" class="hidden" aria-labelledby="accordion-heading-4">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed text-sm md:text-base">
                        Currently, Bromo National Park policy does not allow drones to be flown at any point or spot. However, flying drones is permitted at Tumpak Sewu and Ijen Crater (depending on wind conditions).
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow-sm border border-white/60 overflow-hidden animate-fade-up" style="animation-delay: 0.7s" data-accordion-item>
                <h2 id="accordion-heading-5">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-700 transition-all duration-300 focus:ring-0 focus:outline-none gap-4 hover:pl-7" data-accordion-target="#accordion-body-5" aria-expanded="false" aria-controls="accordion-body-5">
                        <span>How about tour availability?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-5" class="hidden" aria-labelledby="accordion-heading-5">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed text-sm md:text-base">
                        Tours are available daily, unless there is a closure by local authorities due to local events or routine agendas, which will be announced with prior notice.
                    </div>
                </div>
            </div>

        </div>
        
        <div class="text-center mt-16 animate-fade-up relative z-10" style="animation-delay: 0.8s">
            <p class="text-gray-500 mb-6">Still have questions?</p>
            {{-- WhatsApp Button (Kept Green) --}}
            <a href="https://wa.me/6281217006076" target="_blank" 
               class="inline-flex items-center px-8 py-3 bg-[#25D366] text-white font-bold rounded-full hover:bg-[#20bd5a] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 group">
                <i class="fab fa-whatsapp text-xl mr-2 group-hover:scale-110 transition-transform"></i> Chat Support
            </a>
        </div>
    </section>

    @include('components.client.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
@endsection