@extends('_layouts.app')

@section('head')
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden bg-gray-900">
        <!-- Background Image -->
        <img src="{{ asset('assets/images/jumbotron/background-jumbo.png') }}" alt="Travel Destination"
            class="absolute inset-0 w-full h-full object-cover object-center opacity-70">

        <!-- Content -->
        <div class="container mx-auto px-6 relative z-20 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Let's Journey and<br>
                Discover a Place
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                ipsum has been the industry's standard dummy text ever since the 1500s.
            </p>
        </div>
    </section>

    <!-- About Section -->
    <section class="max-w-7xl mx-auto px-6 py-24"> <!-- Increased py from 16 to 24 -->
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            <!-- Text Content -->
            <div class="lg:w-1/2">
                <span class="text-primary text-sm font-semibold tracking-wider uppercase">
                    ABOUT ME
                </span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-6">
                    Let's know About Our<br>
                    Journey For TripRex
                </h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Etiam ac tortor id purus commodo vulputate. Vestibulum porttitor erat felis and sed vehicula tortor
                    malesuada gravida. Mauris volutpat enim quis pulv gont congue. Suspendisse ullamcorper, enim vitae
                    tristique blandit, eratot augue torel tempo libero, non porta lectus tortor et elit.
                </p>
                <button class="bg-primary text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
                    More About
                </button>
            </div>

            <!-- Image Grid -->
            <div class="lg:w-1/2 grid grid-cols-2 gap-4">
                <div class="col-span-1">
                    <img src="https://placehold.co/400x500?text=Travel+Experience" alt="Travel experience"
                        class="w-full h-full object-cover rounded-lg">

                </div>
                <div class="col-span-1 grid gap-4">
                    <img src="https://placehold.co/400x240?text=Waterfall+View" alt="Waterfall view"
                        class="w-full h-full object-cover rounded-lg">
                    <img src="https://placehold.co/400x240?text=Mountain+Adventure" alt="Mountain adventure"
                        class="w-full h-full object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Top Destination Section -->
    <section class="max-w-7xl mx-auto px-6 py-24 bg-gray-50"> <!-- Increased py from 16 to 24 -->
        <div class="text-center mb-16"> <!-- Increased mb from 12 to 16 -->
            <span class="text-primary text-sm font-semibold tracking-wider uppercase">
                TOP SELLING
            </span>
            <h2 class="text-3xl font-bold text-gray-900 mb-10">
                Top Destination
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"> <!-- Increased gap from 6 to 8 -->
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                <img src="https://placehold.co/600x400?text=Bromo+Tour" alt="Bromo Tour" class="w-full h-48 object-cover">
                <div class="p-6"> <!-- Increased p from 4 to 6 -->
                    <div class="flex justify-between items-center mb-3"> <!-- Increased mb from 2 to 3 -->
                        <span class="text-sm text-gray-600">1 Day Tour</span>
                        <span class="text-sm font-semibold">Rp. 3.650.000</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Bromo Midnight</span>
                    </div>
                    <button
                        class="w-full bg-primary text-white py-2 rounded-md hover:bg-blue-700 transition flex justify-between items-center px-4">
                        <span class="text-sm font-medium">BOOK NOW</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                <img src="https://placehold.co/600x400?text=Bromo+Tumpak+Sewu" alt="Bromo Tumpak Sewu"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-600">2 Day 1 Night</span>
                        <span class="text-sm font-semibold">Rp. 3.050.000</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Bromo, Tumpak Sewu</span>
                    </div>
                    <button
                        class="w-full bg-primary text-white py-2 rounded-md hover:bg-blue-700 transition flex justify-between items-center px-4">
                        <span class="text-sm font-medium">BOOK NOW</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                <img src="https://placehold.co/600x400?text=Bromo+Ijen" alt="Bromo Ijen" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-600">3 Day 2 Night</span>
                        <span class="text-sm font-semibold">Rp. 3.650.000</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Bromo, Tumpak Sewu, Kawah Ijen</span>
                    </div>
                    <button
                        class="w-full bg-primary text-white py-2 rounded-md hover:bg-blue-700 transition flex justify-between items-center px-4">
                        <span class="text-sm font-medium">BOOK NOW</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                <img src="https://placehold.co/600x400?text=Custom+Trip" alt="Custom Trip" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-600">Request Trip</span>
                        <span class="text-sm font-semibold">Custom</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>You can request for your trip</span>
                    </div>
                    <button
                        class="w-full bg-primary text-white py-2 rounded-md hover:bg-blue-700 transition flex justify-between items-center px-4">
                        <span class="text-sm font-medium">BOOK NOW</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Exploration Section -->
    <section class="max-w-7xl mx-auto px-6 py-24"> <!-- Increased py from 16 to 24 -->
        <div class="text-center mb-16"> <!-- Increased mb from 12 to 16 -->
            <span class="text-primary text-sm font-semibold tracking-wider uppercase">
                EXPLORASI BROMO MIDNIGHT & KAWAH IJEN
            </span>
            <h3 class="text-xl font-semibold text-gray-900 mb-10">
                2 Hari 1 Malam - Wisata Alam Tropis & Petualangan Ringan
            </h3>
        </div>

        <div class="flex flex-col lg:flex-row gap-12"> <!-- Increased gap from 8 to 12 -->
            <!-- Buttons -->
            <div class="lg:w-1/4 space-y-6"> <!-- Increased space-y from 4 to 6 -->
                <button
                    class="w-full bg-primary text-white py-3 rounded-md flex items-center justify-center gap-2 hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                        </path>
                    </svg>
                    <span>Maps</span>
                </button>
                <button
                    class="w-full bg-gray-200 text-gray-800 py-3 rounded-md flex items-center justify-center gap-2 hover:bg-gray-300 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    <span>Facility</span>
                </button>
                <button
                    class="w-full bg-gray-100 text-gray-800 py-3 rounded-md flex items-center justify-center gap-2 hover:bg-gray-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Itinerary</span>
                </button>
            </div>

            <!-- Content -->
            <div class="lg:w-2/4">
                <h4 class="text-xl font-semibold text-gray-900 mb-6"> <!-- Increased mb from 4 to 6 -->
                    Thrill Above Ground: The Zip Line Adventure
                </h4>
                <p class="text-gray-600 mb-8"> <!-- Increased mb from 6 to 8 -->
                    Embark on an exhilarating outdoor journey, zipping through lush landscapes,
                    feeling the wind rush past and experiencing nature from breathtaking heights.
                    Unleash your inner adventurer today.
                </p>
                <ul class="space-y-4"> <!-- Increased space-y from 2 to 4 -->
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">Treetop Views</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">Adrenaline Rush</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">Safety Measures</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">Nature Immersion</span>
                    </li>
                </ul>
            </div>

            <!-- Images -->
            <div class="lg:w-1/4 space-y-6"> <!-- Increased space-y from 4 to 6 -->
                <img src="https://placehold.co/400x300?text=Zip+Line+Adventure" alt="Zip Line Adventure"
                    class="w-full h-auto rounded-lg">
                <img src="https://placehold.co/400x300?text=Mountain+Hiking" alt="Mountain Hiking"
                    class="w-full h-auto rounded-lg">
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="max-w-7xl mx-auto px-6 py-24 bg-gray-50"> <!-- Increased py from 16 to 24 -->
        <div class="text-center mb-16"> <!-- Increased mb from 12 to 16 -->
            <span class="text-primary text-sm font-semibold tracking-wider uppercase">
                OUR SUCCESS
            </span>
            <h3 class="text-2xl font-bold text-gray-900 mb-10">
                Why Choose Ann Trans
            </h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"> <!-- Increased gap from 6 to 8 -->
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200"> <!-- Increased p from 6 to 8 -->
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-3">Worldwide Coverage</h4> <!-- Increased mb from 2 to 3 -->
                        <p class="text-gray-600 text-sm">
                            We provide tours and travel services worldwide with local expertise.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-start">
                    <div class="bg-yellow-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-3">Competitive Pricing</h4>
                        <p class="text-gray-600 text-sm">
                            Affordable prices with best value packages for all travelers.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-start">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-3">Fast Booking</h4>
                        <p class="text-gray-600 text-sm">
                            Quick and easy booking process with instant confirmation.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-start">
                    <div class="bg-purple-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-3">Guided Tours</h4>
                        <p class="text-gray-600 text-sm">
                            Experienced guides to enhance your travel experience.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-start">
                    <div class="bg-red-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-3">Best Support 24/7</h4>
                        <p class="text-gray-600 text-sm">
                            Customer support available around the clock for your convenience.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-start">
                    <div class="bg-indigo-100 p-3 rounded-full mr-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-3">Ultimate Flexibility</h4>
                        <p class="text-gray-600 text-sm">
                            Flexible booking options and customizable travel plans.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Galery Section --}}
    <section class="max-w-7xl mx-auto px-6 py-24 bg-gray-50"> <!-- Increased py from 16 to 24 -->
        <div class="text-center mb-16"> <!-- Increased mb from 12 to 16 -->
            <span class="text-primary text-sm font-semibold tracking-wider uppercase">
                OUR SUCCESS
            </span>
            <h3 class="text-2xl font-bold text-gray-900 mb-10">
                Why Choose Ann Trans
            </h3>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-6 xl:gap-8">
            <!-- image - start -->
            <a href="#" class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
                <img src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&q=75&fit=crop&w=600"
                    loading="lazy" alt="Photo by Minh Pham"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                <div
                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                </div>

                <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">VR</span>
            </a>
            <!-- image - end -->

            <!-- image - start -->
            <a href="#"
                class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:col-span-2 md:h-80">
                <img src="https://images.unsplash.com/photo-1542759564-7ccbb6ac450a?auto=format&q=75&fit=crop&w=1000"
                    loading="lazy" alt="Photo by Magicle"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                <div
                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                </div>

                <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Tech</span>
            </a>
            <!-- image - end -->

            <!-- image - start -->
            <a href="#"
                class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:col-span-2 md:h-80">
                <img src="https://images.unsplash.com/photo-1610465299996-30f240ac2b1c?auto=format&q=75&fit=crop&w=1000"
                    loading="lazy" alt="Photo by Martin Sanchez"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                <div
                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                </div>

                <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Dev</span>
            </a>
            <!-- image - end -->

            <!-- image - start -->
            <a href="#" class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&q=75&fit=crop&w=600"
                    loading="lazy" alt="Photo by Lorenzo Herrera"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                <div
                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                </div>

                <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg">Retro</span>
            </a>
            <!-- image - end -->
        </div>
    </section>


    <!-- Testimonials Section -->
    <section class="max-w-7xl mx-auto px-6 py-24"> <!-- Increased py from 16 to 24 -->
        <div class="text-center mb-16"> <!-- Increased mb from 12 to 16 -->
            <span class="text-primary text-sm font-semibold tracking-wider uppercase">
                TESTIMONIALS
            </span>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                What People Say About Us.
            </h3>
        </div>

        <div class="bg-white p-10 rounded-lg shadow-md max-w-2xl mx-auto relative"> <!-- Increased p from 8 to 10 -->
            <div class="absolute top-0 left-0 -mt-4 -ml-4 bg-primary text-white p-2 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                    </path>
                </svg>
            </div>
            <p class="text-gray-600 italic mb-8"> <!-- Increased mb from 6 to 8 -->
                "On the Windows talking painted pasture yet its express parties use. Sure last upon he same as knew next. Of
                believed or diverted no."
            </p>
            <div class="flex items-center">
                <img src="https://placehold.co/60x60?text=Avatar" alt="Mike Taylor" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <h4 class="font-semibold">Mike Taylor</h4>
                    <p class="text-gray-500 text-sm">Lahore, Pakistan</p>
                </div>
            </div>
        </div>
    </section>
@endsection