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
            <!-- FAQ 1: Airport/Train Station Pickup -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Is it possible to pick up at the airport or train station?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Yes. Please make sure the flight arrival is before 4:00 AM. If arriving by train, please ensure you arrive at least 1 hour before the scheduled pick-up time.
                </div>
            </div>

            <!-- FAQ 2: Airport/Train Station Drop-off -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Is it possible to be dropped off at the airport or train station?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Yes, drop-offs at either Surabaya or Denpasar airport are possible. Please ensure your flight or train departure is at least 2 hours after 5:00 PM (17:00) — a flight departing around 19:00 should be fine. If you're taking a train heading west (e.g., to Yogyakarta), we suggest Ketapang train station.
                </div>
            </div>

            <!-- FAQ 3: Luggage During Tour -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Do I have to carry my luggage during the tour?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Yes, but you will leave your luggage in the car while you’re doing the activities.
                </div>
            </div>

            <!-- FAQ 4: Drone Policy -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Is it allowed to fly a drone?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Currently, Bromo National Park policy does not allow drones to be flown at any point or spot. However, flying drones is permitted at Tumpak Sewu and Ijen.
                </div>
            </div>

            <!-- FAQ 5: Tour Availability -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    How about tour availability?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Tours are available daily, unless there is a closure by local authorities due to local events or routine agendas, which will be announced with prior notice.
                </div>
            </div>

            <!-- FAQ 6: Tour Closure Dates -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    When are tours not available?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Tours are not available on the following dates due to Mt. Ijen cleaning routine and Nyepi (Hindu Silence Day) in Bromo:<br>
                    February 5th, March 5th, March 28th & 29th (Silence Day), April 2nd, April 30th, June 4th, July 2nd, July 30th, September 3rd, October 3rd, November 5th, December 3rd.<br>
                    There might be additional closure dates due to local events — we will inform you after receiving an official announcement.
                </div>
            </div>

            <!-- FAQ 7: Accommodations -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    What type of accommodations are provided?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Accommodation is in a guesthouse or small hotel, with a private room and en-suite bathroom.
                </div>
            </div>

            <!-- FAQ 8: Overnight in Bondowoso -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Why do we overnight in Bondowoso instead of near Ijen?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    The driving duration from Bromo to Bondowoso is 4 hours, versus 6 hours if driving directly to Ijen. Staying in Bondowoso splits the long drive for greater comfort. However, if Bondowoso accommodations are unavailable, we may alter the overnight location to Ijen.
                </div>
            </div>

            <!-- FAQ 9: How to Book -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    How do I book a tour?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    (1) Click the checkout button to access the deposit payment link.<br>
                    (2) A deposit of IDR 500K is required to secure/reserve your space (2% card charge applies).<br>
                    (3) Complete the Booking Form with your specific details.<br>
                    (4) You will receive a Booking Confirmation via email and WhatsApp.
                </div>
            </div>

            <!-- FAQ 10: Remaining Payment -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    How do I pay the remaining balance?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    The remaining payment can be made in cash during the tour. Payment by card is also possible if arranged at least 5 days prior to the tour start date. A separate card payment link is subject to a 2% admin charge.
                </div>
            </div>

            <!-- FAQ 11: Drop-off in Surabaya or Malang -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Can I finish/drop off in Surabaya or Malang?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Yes. An additional cost of IDR 100K per person will be applied.
                </div>
            </div>

            <!-- FAQ 12: Private Group Upgrade -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up">
                <button class="w-full text-left p-6 font-semibold text-gray-800 flex items-center justify-between hover:bg-gray-50 transition"
                        aria-expanded="false"
                        onclick="toggleAccordion(this)">
                    Is it possible to upgrade to a private group?
                </button>
                <div class="accordion-panel px-6 pb-6 text-gray-600">
                    Yes. Additional charges apply. Please contact us at septemtour@gmail.com or WhatsApp/Telegram: 081220005276.
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

                // Close all panels first
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

            // Add delay to fade-up animations for sequential appearance
            document.addEventListener('DOMContentLoaded', function() {
                const fadeElements = document.querySelectorAll('.animate-fade-up');
                fadeElements.forEach((el, index) => {
                    el.style.animationDelay = `${index * 0.1}s`;
                });
            });
        </script>
    @endpush
@endsection