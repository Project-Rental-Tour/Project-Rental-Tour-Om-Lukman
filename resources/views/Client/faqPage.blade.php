@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
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

    <!-- FAQ Accordion with Flowbite -->
    <section class="max-w-4xl mx-auto px-6 pb-24">
        <div class="space-y-6" id="accordion-open" data-accordion="open">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-1">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-1" aria-expanded="false" aria-controls="accordion-open-body-1">
                        <span>Is it possible to pick up at the airport or train station?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Yes. Please make sure the flight arrival is before 4:00 AM. If by train, 1 hour before pick up time is fine.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-2">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">
                        <span>Is it possible to be dropped off at the airport or train station?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Yes, either Surabaya or Denpasar airport are possible. Please make sure the flight/train departure is 2 hours later than 5:00 PM (17:00) — a flight leaving around 19:00 should be fine. If taking a train to the west (e.g., Yogyakarta), we suggest Ketapang train station.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-3">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-3" aria-expanded="false" aria-controls="accordion-open-body-3">
                        <span>Do I have to carry my luggage during the tour?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Yes. But you will leave it in the car while you’re doing the activity.
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-4">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-4" aria-expanded="false" aria-controls="accordion-open-body-4">
                        <span>Is it allowed to fly a drone?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-4" class="hidden" aria-labelledby="accordion-open-heading-4">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Currently, Bromo National Park policy does not allow drones to be flown at any point or spot. However, flying drones is permitted at Tumpak Sewu and Ijen.
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-5">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-5" aria-expanded="false" aria-controls="accordion-open-body-5">
                        <span>How about tour availability?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-5" class="hidden" aria-labelledby="accordion-open-heading-5">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Tours are available daily, unless there is a closure by local authorities due to local events or routine agendas, which will be announced with prior notice.
                    </div>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-6">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-6" aria-expanded="false" aria-controls="accordion-open-body-6">
                        <span>When are tours not available?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-6" class="hidden" aria-labelledby="accordion-open-heading-6">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Tours are not available on the following dates due to Mt. Ijen cleaning routine and Nyepi (Hindu Silence Day) in Bromo:<br><br>
                        February 5th, March 5th, March 28th & 29th (Silence Day), April 2nd, April 30th, June 4th, July 2nd, July 30th, September 3rd, October 3rd, November 5th, December 3rd.<br><br>
                        There might be additional closure dates due to local events — we will inform you after receiving an official announcement.
                    </div>
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-7">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-7" aria-expanded="false" aria-controls="accordion-open-body-7">
                        <span>What type of accommodations are provided?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-7" class="hidden" aria-labelledby="accordion-open-heading-7">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Accommodation is in a guesthouse or small hotel, with a private room and en-suite bathroom.
                    </div>
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-8">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-8" aria-expanded="false" aria-controls="accordion-open-body-8">
                        <span>Why do we overnight in Bondowoso instead of near Ijen?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-8" class="hidden" aria-labelledby="accordion-open-heading-8">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        The driving duration from Bromo to Bondowoso is 4 hours, versus 6 hours if driving directly to Ijen. Staying in Bondowoso splits the long drive for greater comfort. However, if Bondowoso accommodations are unavailable, we may alter the overnight location to Ijen.
                    </div>
                </div>
            </div>

            <!-- FAQ 9 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-9">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-9" aria-expanded="false" aria-controls="accordion-open-body-9">
                        <span>How do I book a tour?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-9" class="hidden" aria-labelledby="accordion-open-heading-9">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        <ol class="list-decimal pl-5 space-y-2">
                            <li>Click the checkout button to access the deposit payment link.</li>
                            <li>A deposit of IDR 500K is required to secure/reserve your space (2% card charge applies).</li>
                            <li>Complete the Booking Form with your specific details.</li>
                            <li>You will receive a Booking Confirmation via email and WhatsApp.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- FAQ 10 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-10">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-10" aria-expanded="false" aria-controls="accordion-open-body-10">
                        <span>How do I pay the remaining balance?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-10" class="hidden" aria-labelledby="accordion-open-heading-10">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        The remaining payment can be made in cash during the tour. Payment by card is also possible if arranged at least 5 days prior to the tour start date. A separate card payment link is subject to a 2% admin charge.
                    </div>
                </div>
            </div>

            <!-- FAQ 11 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-11">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-11" aria-expanded="false" aria-controls="accordion-open-body-11">
                        <span>Can I finish/drop off in Surabaya or Malang?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-11" class="hidden" aria-labelledby="accordion-open-heading-11">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Yes. An additional cost of IDR 100K per person will be applied.
                    </div>
                </div>
            </div>

            <!-- FAQ 12 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                <h2 id="accordion-open-heading-12">
                    <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-12" aria-expanded="false" aria-controls="accordion-open-body-12">
                        <span>Is it possible to upgrade to a private group?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-open-body-12" class="hidden" aria-labelledby="accordion-open-heading-12">
                    <div class="p-6 text-gray-600 border-t border-gray-200">
                        Yes. Additional charges apply. Please contact us at <strong>septemtour@gmail.com</strong> or WhatsApp/Telegram: <strong>081220005276</strong>.
                    </div>
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
        <!-- Flowbite JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

        <script>
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