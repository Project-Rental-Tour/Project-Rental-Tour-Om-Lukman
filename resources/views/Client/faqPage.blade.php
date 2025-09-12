@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .bg-primary { background-color: #799eff; }
        .text-primary { color: #799eff; }
        .bg-primary-opacity { background-color: rgba(121, 158, 255, 0.05);}
        .text-white { color: #ffffff; }
        .text-green { color: #10b981; }

        /* Animasi muncul bertahap */
        .animate-fade-up {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeUp 0.6s ease-out forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Accordion styling */
        .accordion-button::after {
            content: '+';
            font-size: 1.5rem;
            margin-left: auto;
            transition: transform 0.3s ease;
        }
        .accordion-button[aria-expanded="true"]::after {
            content: '−';
        }
        .accordion-panel {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, padding 0.3s ease;
        }
        .accordion-panel[aria-expanded="true"] {
            max-height: 500px;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <!-- Header Section -->
    <br>
    <br>
    <section class="max-w-4xl mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4 animate-fade-up">
            Frequently Asked Questions
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-up">
            Find answers to the most common questions about our travel packages, booking process, and what to expect on your journey.
        </p>
    </section>

    <!-- FAQ Accordion -->
    <section class="max-w-4xl mx-auto px-6 pb-24">
        <div class="space-y-6">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    How do I book a trip?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Booking is simple! Browse our destinations, select a package, and click "Book Now". Fill in your details, choose your travel date, and confirm your payment. You’ll receive a confirmation email within 24 hours.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    What’s included in the price?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Most packages include accommodation, transportation during the trip, entrance fees, meals as specified, and a professional guide. Exact inclusions are listed on each destination page under "Facility".
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Can I customize my itinerary?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Absolutely! We offer fully customizable trips. Click “Design Your Trip” and tell us your dream destination, dates, group size, and preferences. Our team will create a personalized package just for you.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    What if I need to cancel or reschedule?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    We offer flexible rescheduling based on availability. Cancellations are subject to our refund policy, which varies by package. Please contact us as early as possible so we can assist you best.
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Do you provide travel insurance?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Travel insurance is not included by default but highly recommended. We can assist you in purchasing coverage that fits your needs. Let us know during booking!
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Are solo travelers welcome?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Yes! Many of our trips are perfect for solo travelers. You’ll be grouped with other guests, and our guides ensure everyone feels safe and included throughout the journey.
                </div>
            </div>
        </div>
    </section>

    <!-- WhatsApp Floating Button -->
    <a 
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20get%20some%20information%3A%0A-%20Destination%3A%20%5BEnter%20your%20preferred%20destination%5D%0A-%20Number%20of%20Travelers%3A%20%5BEnter%20number%5D%0A-%20Travel%20Date%3A%20%5BEnter%20date%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
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
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
        <script>
            function toggleAccordion(button) {
                const panel = button.nextElementSibling;
                const isExpanded = button.getAttribute('aria-expanded') === 'true';

                // Close all panels first (optional: for single open)
                document.querySelectorAll('.accordion-button').forEach(btn => {
                    btn.setAttribute('aria-expanded', 'false');
                });
                document.querySelectorAll('.accordion-panel').forEach(pnl => {
                    pnl.setAttribute('aria-expanded', 'false');
                });

                // Toggle current
                button.setAttribute('aria-expanded', !isExpanded);
                panel.setAttribute('aria-expanded', !isExpanded);
            }

            // Initialize: add class name for JS control
            document.querySelectorAll('.accordion-panel').forEach(panel => {
                panel.classList.add('accordion-panel');
            });
            document.querySelectorAll('button[aria-expanded]').forEach(btn => {
                btn.classList.add('accordion-button');
            });
        </script>
    @endpush
@endsection