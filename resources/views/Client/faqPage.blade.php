@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <style>
        /* --- Premium Green Theme Configuration (Same as Master) --- */
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
        [data-accordion-item] button[aria-expanded="true"] {
            background-color: rgba(10, 61, 38, 0.05);
            color: var(--color-primary);
        }
        
        [data-accordion-item] button:hover {
            background-color: rgba(10, 61, 38, 0.02);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section class="max-w-4xl mx-auto px-6 py-24 text-center mt-0">
        <span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs mb-4 block animate-fade-up">Help Center</span>
        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-6 animate-fade-up font-serif" style="animation-delay: 0.1s">
            Frequently Asked Questions
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto animate-fade-up font-light leading-relaxed" style="animation-delay: 0.2s">
            Find answers to the most common questions about our travel packages, booking process, and what to expect on your journey with Septem Tour.
        </p>
    </section>

    <section class="max-w-3xl mx-auto px-6 pb-32">
        <div class="space-y-4" id="accordion-open" data-accordion="open">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up" style="animation-delay: 0.3s" data-accordion-item>
                <h2 id="accordion-heading-1">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 transition-all duration-300 focus:ring-0 focus:outline-none gap-4" data-accordion-target="#accordion-body-1" aria-expanded="true" aria-controls="accordion-body-1">
                        <span>Is it possible to pick up at the airport or train station?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-1" class="hidden" aria-labelledby="accordion-heading-1">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed">
                        Yes. Please make sure the flight arrival is before 4:00 AM. If by train, 1 hour before pick up time is fine.
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up" style="animation-delay: 0.4s" data-accordion-item>
                <h2 id="accordion-heading-2">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 transition-all duration-300 focus:ring-0 focus:outline-none gap-4" data-accordion-target="#accordion-body-2" aria-expanded="false" aria-controls="accordion-body-2">
                        <span>Is it possible to be dropped off at the airport or train station?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-2" class="hidden" aria-labelledby="accordion-heading-2">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed">
                        Yes, either Surabaya or Denpasar airport are possible. Please make sure the flight/train departure is 2 hours later than 5:00 PM (17:00) — a flight leaving around 19:00 should be fine. If taking a train to the west (e.g., Yogyakarta), we suggest Ketapang train station.
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up" style="animation-delay: 0.5s" data-accordion-item>
                <h2 id="accordion-heading-3">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 transition-all duration-300 focus:ring-0 focus:outline-none gap-4" data-accordion-target="#accordion-body-3" aria-expanded="false" aria-controls="accordion-body-3">
                        <span>Do I have to carry my luggage during the tour?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-3" class="hidden" aria-labelledby="accordion-heading-3">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed">
                        Yes. But you will leave it in the car while you’re doing the activity. Our drivers will ensure your belongings are safe.
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up" style="animation-delay: 0.6s" data-accordion-item>
                <h2 id="accordion-heading-4">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 transition-all duration-300 focus:ring-0 focus:outline-none gap-4" data-accordion-target="#accordion-body-4" aria-expanded="false" aria-controls="accordion-body-4">
                        <span>Is it allowed to fly a drone?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-4" class="hidden" aria-labelledby="accordion-heading-4">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed">
                        Currently, Bromo National Park policy does not allow drones to be flown at any point or spot. However, flying drones is permitted at Tumpak Sewu and Ijen Crater (depending on wind conditions).
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-up" style="animation-delay: 0.7s" data-accordion-item>
                <h2 id="accordion-heading-5">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 transition-all duration-300 focus:ring-0 focus:outline-none gap-4" data-accordion-target="#accordion-body-5" aria-expanded="false" aria-controls="accordion-body-5">
                        <span>How about tour availability?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-secondary transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-body-5" class="hidden" aria-labelledby="accordion-heading-5">
                    <div class="p-6 pt-0 text-gray-600 border-t border-transparent leading-relaxed">
                        Tours are available daily, unless there is a closure by local authorities due to local events or routine agendas, which will be announced with prior notice.
                    </div>
                </div>
            </div>

        </div>
        
        <div class="text-center mt-16 animate-fade-up" style="animation-delay: 0.8s">
            <p class="text-gray-500 mb-6">Still have questions?</p>
            <a href="https://wa.me/6281220005276" target="_blank" 
               class="inline-flex items-center px-8 py-3 bg-[#25D366] text-white font-bold rounded-full hover:bg-[#20bd5a] transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                <i class="fab fa-whatsapp text-xl mr-2"></i> Chat Support
            </a>
        </div>
    </section>

    @include('components.client.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
@endsection 