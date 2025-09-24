@extends('_layouts.user')

@section('head')
    <style>

        /* Pastikan carousel tidak mengganggu breadcrumb */
        #default-carousel {
            position: relative;
            z-index: 1; /* Pastikan carousel berada di bawah breadcrumb */
        }

        
        .text-muted {
            color: #64748b;
        }

        .header-gap {
            margin-top: 3rem;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white h-96" id="jumbotron">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <img loading="lazy" src="{{ asset($car->image_car_1) }}" alt="{{ $car->name_car }}"
            class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl">
                    <span class="bg-blue-600 text-white text-sm px-3 py-1 rounded-full mb-4 inline-block">
                        {{ ucfirst($car->car_type ?? 'General') }} Car
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $car->name_car }}</h1>
                    <p class="text-xl text-blue-200 mb-6">
                        {{ $car->capacity }} seats • {{ ucfirst($car->transmission) }} Transmission
                    </p>
                    <div class="flex flex-wrap items-center gap-6 text-lg">
                        <span class="font-bold text-yellow-300 text-2xl">
                            Rp{{ number_format($car->price, 0, ',', '.') }} <span
                                class="text-sm font-normal">/day</span>
                        </span>
                        <span class="bg-{{ $car->car_status == 'available' ? 'green' : 'red' }}-600 px-3 py-1 rounded-md text-sm text-white">
                            {{ ucfirst($car->car_status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-white py-4 shadow-sm sticky top-16 z-30">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li class="font-medium text-gray-900"><a href="{{ route('index') }}">Home</a></li>
                <li class="text-gray-400">/</li>
                <li class="font-medium text-gray-900"><a href="{{ route('usercar.index') }}">Cars</a></li>
                <li class="text-gray-400">/</li>
                <li class="font-medium text-gray-900">{{ $car->name_car }}</li>
            </ol>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="container mx-auto px-6 py-12 space-y-12">
        <!-- Gallery + Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Gallery - {{ $car->name_car }}</h3>
                
                <!-- Carousel Wrapper -->
                <div id="default-carousel" class="relative w-full h-96 rounded-xl overflow-hidden" data-carousel="static">
                    <!-- Carousel Images -->
                    <div class="relative h-full overflow-hidden">
                        @if($car->image_car_1)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ !$car->image_car_2 && !$car->image_car_3 ? 'active' : '' }}">
                                <img src="{{ asset($car->image_car_1) }}" 
                                    class="block w-full h-full object-cover" 
                                    alt="{{ $car->name_car }} - Main">
                            </div>
                        @endif

                        @if($car->image_car_2)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ !$car->image_car_1 && !$car->image_car_3 ? 'active' : '' }}">
                                <img src="{{ asset($car->image_car_2) }}" 
                                    class="block w-full h-full object-cover" 
                                    alt="{{ $car->name_car }} - Image 2">
                            </div>
                        @endif

                        @if($car->image_car_3)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ !$car->image_car_1 && !$car->image_car_2 ? 'active' : '' }}">
                                <img src="{{ asset($car->image_car_3) }}" 
                                    class="block w-full h-full object-cover" 
                                    alt="{{ $car->name_car }} - Image 3">
                            </div>
                        @endif
                    </div>

                    <!-- Navigation Arrows -->
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>

                    <!-- Pagination Dots -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        @if($car->image_car_1)
                            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800 focus:outline-none" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        @endif
                        @if($car->image_car_2)
                            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800 focus:outline-none" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        @endif
                        @if($car->image_car_3)
                            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800 focus:outline-none" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        @endif
                    </div>
                </div>
                </div>
            </div>
            <div class="bg-blue-50 p-6 rounded-xl space-y-4">
                <h4 class="font-semibold text-lg text-gray-800">Description</h4>
                <div class="text-sm text-gray-700">{{ $car->description }}</div>
                <div class="pt-2">
                    <span class="text-xs text-gray-500">Based on {{ $car->name_car }}</span>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="rounded-xl shadow-lg overflow-hidden bg-white">
            <!-- Tabs Header -->
            <div class="px-2 py-2 border-gray-200">
                <ul class="flex flex-wrap text-sm font-medium text-center -mb-px" role="tablist">
                    <!-- Tab 1: Details -->
                    <li class="me-1" role="presentation">
                        <button
                            id="details-tab"
                            data-tabs-target="#details"
                            type="button"
                            role="tab"
                            aria-controls="details"
                            aria-selected="true"
                            class="inline-block px-6 py-3 rounded-xl text-blue-700 bg-blue-100 transition-all duration-300 hover:bg-blue-200 focus:outline-none focus:ring-blue-100 font-semibold">
                            Details
                        </button>
                    </li>

                    <!-- Tab 2: Specifications -->
                    <li class="me-1" role="presentation">
                        <button
                            id="specifications-tab"
                            data-tabs-target="#specifications"
                            type="button"
                            role="tab"
                            aria-controls="specifications"
                            aria-selected="false"
                            class="inline-block px-6 py-3 rounded-xl text-gray-700 transition-all duration-300 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-blue-100 font-semibold">
                            Specifications
                        </button>
                    </li>

                    <!-- Tab 3: Features -->
                    <li class="me-1" role="presentation">
                        <button
                            id="features-tab"
                            data-tabs-target="#features"
                            type="button"
                            role="tab"
                            aria-controls="features"
                            aria-selected="false"
                            class="inline-block px-6 py-3 rounded-xl text-gray-700 transition-all duration-300 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-blue-100 font-semibold">
                            Features
                        </button>
                    </li>

                    <!-- Tab 4: Notes -->
                    <li class="me-1" role="presentation">
                        <button
                            id="notes-tab"
                            data-tabs-target="#notes"
                            type="button"
                            role="tab"
                            aria-controls="notes"
                            aria-selected="false"
                            class="inline-block px-6 py-3 rounded-xl text-gray-700 transition-all duration-300 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-blue-100 font-semibold">
                            Notes
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tabs Content -->
            <div id="myTabContent" class="p-6">
                <!-- Details Tab -->
                <div class="block animate-fade-in" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">Car Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Car Name</h4>
                            <p class="text-gray-800 text-base">{{ $car->name_car }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Car Type</h4>
                            <p class="text-gray-800">{{ $car->car_type ?? 'Not specified' }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Transmission</h4>
                            <p class="text-gray-800">{{ ucfirst($car->transmission) }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Capacity</h4>
                            <p class="text-gray-800">{{ $car->capacity }} seats</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Rental Type</h4>
                            <p class="text-gray-800">{{ $car->rental_type ? 'With Driver' : 'Self Drive' }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Price</h4>
                            <p class="text-gray-800">Rp{{ number_format($car->price, 0, ',', '.') }}/day</p>
                        </div>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div class="hidden animate-fade-in" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">Technical Specifications</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-3">Engine & Performance</h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Transmission</span>
                                    <span class="font-medium">{{ ucfirst($car->transmission) }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Seating Capacity</span>
                                    <span class="font-medium">{{ $car->capacity }} seats</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-3">Dimensions</h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Car Type</span>
                                    <span class="font-medium">{{ $car->car_type ?? 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Status</span>
                                    <span class="font-medium capitalize">{{ $car->car_status }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Features Tab -->
                <div class="hidden animate-fade-in" id="features" role="tabpanel" aria-labelledby="features-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Features & Amenities</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Included Features -->
                        <div>
                            <h4 class="font-bold text-green-700 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Included Features
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode('.', $car->include) as $item)
                                    @if(trim($item))
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="w-2 h-2 bg-green-600 rounded-full mt-2 flex-shrink-0"></span>
                                            {{ trim($item) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <!-- Additional Features -->
                        <div>
                            <h4 class="font-bold text-blue-700 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Additional Features
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode('.', $car->include) as $item)
                                    @if(trim($item))
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"></span>
                                           {{ $item }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Notes Tab -->
                <div class="hidden animate-fade-in" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">Important Notes</h3>
                    <div class="space-y-4">
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 max-w-full">
                                        @php
                                            $lines = explode("\n", $car->notes);
                                        @endphp
                                        @foreach($lines as $line)
                                            @if(trim($line))
                                                    <span class="text-gray-700 break-words max-w-full">{{ trim($line) }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- FAQ Section -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Frequently Asked Questions</h3>
            <div class="space-y-6" id="accordion-open" data-accordion="open">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                    <h2 id="accordion-open-heading-1">
                        <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-1" aria-expanded="false" aria-controls="accordion-open-body-1">
                            <span>What documents do I need to rent a car?</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                        <div class="p-6 text-gray-600 border-t border-gray-200">
                            For self-drive rentals, you'll need a valid driver's license, ID card/passport, and a credit card for the security deposit. For rentals with driver, only ID card/passport is required.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                    <h2 id="accordion-open-heading-2">
                        <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">
                            <span>Is fuel included in the rental price?</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
                        <div class="p-6 text-gray-600 border-t border-gray-200">
                            Fuel is not included in the rental price. For self-drive rentals, you'll receive the car with a full tank and should return it with a full tank. For rentals with driver, fuel is included in the service.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                    <h2 id="accordion-open-heading-3">
                        <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-3" aria-expanded="false" aria-controls="accordion-open-body-3">
                            <span>What is your cancellation policy?</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
                        <div class="p-6 text-gray-600 border-t border-gray-200">
                            Cancellations made more than 48 hours before pickup are fully refundable. Cancellations within 48 hours will incur a 50% cancellation fee. No-shows will be charged the full rental amount.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                    <h2 id="accordion-open-heading-4">
                        <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-4" aria-expanded="false" aria-controls="accordion-open-body-4">
                            <span>Can I extend my rental period?</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-4" class="hidden" aria-labelledby="accordion-open-heading-4">
                        <div class="p-6 text-gray-600 border-t border-gray-200">
                            Yes, you can extend your rental period subject to availability. Please contact us at least 24 hours before your scheduled return time to arrange an extension.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-up" data-accordion-item>
                    <h2 id="accordion-open-heading-5">
                        <button type="button" class="flex items-center justify-between w-full p-6 font-semibold text-left text-gray-800 hover:bg-gray-50 focus:ring-0 focus:outline-none" data-accordion-target="#accordion-open-body-5" aria-expanded="false" aria-controls="accordion-open-body-5">
                            <span>What should I do in case of an accident or breakdown?</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-5" class="hidden" aria-labelledby="accordion-open-heading-5">
                        <div class="p-6 text-gray-600 border-t border-gray-200">
                            In case of an accident or breakdown, please contact our 24/7 emergency assistance immediately at +62 812-2000-5276. Do not leave the vehicle unattended and wait for our assistance team to arrive.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Booking -->
        <div class="bg-yellow-400 text-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-8 py-10 md:flex md:items-center md:justify-between">
                <div>
                    <h3 class="text-2xl font-bold">Ready to Rent This Car?</h3>
                    <p class="text-gray-100 mt-2">Secure your rental now and hit the road with confidence.</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="{{ route('booking-car.form', $car->slug) }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-medium bg-white text-blue-700 rounded-lg hover:bg-gray-100 transition">
                        Book Now
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- WhatsApp Floating Button -->
    <a 
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20rent%20{{ urlencode($car->name_car) }}%3A%0A-%20Rental%20Dates%3A%20%5BEnter%20dates%5D%0A-%20Number%20of%20Passengers%3A%20%5BEnter%20number%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
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
                    tab.classList.remove('text-blue-700', 'bg-blue-100');
                    tab.classList.add('text-gray-700');
                });
                contents.forEach(content => content.classList.add('hidden'));
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    if (tab.getAttribute('aria-selected') === 'true') return;

                    deactivateAll();

                    // Aktifkan tab terpilih
                    tab.setAttribute('aria-selected', 'true');
                    tab.classList.remove('text-gray-700');
                    tab.classList.add('text-blue-700', 'bg-blue-100');

                    // Tampilkan konten
                    const target = document.querySelector(tab.dataset.tabsTarget);
                    target.classList.remove('hidden');
                    target.classList.add('animate-fade-in');
                });
            });
        });
    </script>
@endsection