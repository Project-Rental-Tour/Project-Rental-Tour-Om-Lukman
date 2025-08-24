@extends('_layouts.user')

@section('head')
@endsection

@section('content')
    @include('components.client.navbar')



    <!-- Dummy Data -->
    <?php
    $destination = (object) [
        'name_package' => 'Bali Adventure Trip',
        'place' => 'Bali, Indonesia',
        'price' => 2500000,
        'time' => '4 Days 3 Nights',
        'category' => 'adventure',
        'level' => 'medium',
        'transportation' => 'Private AC Car & Boat',
        'accommodation' => '3-Star Beachfront Resort',
        'consumption' => 'Daily Breakfast, 2 Lunch, 3 Dinners',
        'pickup_points' => json_encode(['Ngurah Rai Airport', 'Kuta Area Hotel']),
        'dropoff_points' => json_encode(['Airport', 'Seminyak']),
        'activities' => 'White Water Rafting, Trekking, Snorkeling, Cultural Tour',
        'include' => "Accommodation for 3 nights\nMeals as per itinerary\nTransportation during trip\nEntrance fees\nEnglish-speaking guide",
        'exclude' => "International flights\nTravel insurance\nPersonal expenses\nTips for guide",
        'itinerary' => "Day 1: Arrival in Bali\n- Pick up from airport\n- Check-in at resort\n- Welcome dinner at beachside restaurant\n\nDay 2: Adventure Day\n- Morning white water rafting at Ayung River\n- Lunch at riverside café\n- Afternoon trekking to Tegenungan Waterfall\n- Dinner at local warung\n\nDay 3: Island Exploration\n- Morning boat trip to Nusa Penida\n- Snorkeling at Crystal Bay\n- Visit Kelingking Beach\n- Return to Bali\n\nDay 4: Cultural Experience\n- Visit Ubud Monkey Forest\n- Tegalalang Rice Terraces\n- Departure transfer to airport",
        'destination_photo' => '/storage/destinations/bali-adventure.jpg',
    ];
        ?>

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <img src="{{ asset($destination->destination_photo) }}" alt="{{ $destination->name_package }}"
            class="w-full h-96 object-cover object-center">

        <div class="relative container mx-auto px-6 py-24">
            <div class="max-w-3xl">
                <span class="bg-blue-600 text-white text-sm px-3 py-1 rounded-full mb-4 inline-block">
                    {{ ucfirst($destination->category) }} Trip
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $destination->name_package }}</h1>
                <p class="text-xl text-blue-200 mb-6">{{ $destination->place }} • {{ $destination->time }}</p>
                <div class="flex flex-wrap items-center gap-6 text-lg">
                    <span class="font-bold text-yellow-300 text-2xl">
                        Rp.{{ number_format((float) $destination->price, 0, ',', '.') }} <span
                            class="text-sm font-normal">/person</span>
                    </span>
                    <span class="bg-green-600 px-3 py-1 rounded-md text-sm">{{ ucfirst($destination->level) }} Level</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-gray-50 py-4">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
                <li>/</li>
                <li><a href="#" class="hover:text-blue-600">Destinations</a></li>
                <li>/</li>
                <li class="text-gray-900">{{ $destination->name_package }}</li>
            </ol>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="container mx-auto px-6 py-12 space-y-12">
        <!-- Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <img src="{{ asset($destination->destination_photo) }}" alt="Main View"
                    class="w-full h-80 object-cover rounded-xl shadow-lg">
            </div>
            <div class="space-y-6">
                <img src="{{ asset('/storage/destinations/bali-rafting.jpg') }}" alt="Rafting"
                    class="w-full h-36 object-cover rounded-lg shadow-md">
                <img src="{{ asset('/storage/destinations/bali-waterfall.jpg') }}" alt="Waterfall"
                    class="w-full h-36 object-cover rounded-lg shadow-md">
                <img src="{{ asset('/storage/destinations/bali-beach.jpg') }}" alt="Beach"
                    class="w-full h-36 object-cover rounded-lg shadow-md">
            </div>
        </div>

        <!-- Tabs (Flowbite) -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                    data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            id="itinerary-tab" data-tabs-target="#itinerary" type="button" role="tab"
                            aria-controls="itinerary" aria-selected="false">
                            Itinerary
                        </button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            id="inclusion-tab" data-tabs-target="#inclusion" type="button" role="tab"
                            aria-controls="inclusion" aria-selected="false">
                            Inclusions
                        </button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-blue-500 text-blue-600 rounded-t-lg active"
                            id="details-tab" data-tabs-target="#details" type="button" role="tab" aria-controls="details"
                            aria-selected="true">
                            Details
                        </button>
                    </li>
                </ul>
            </div>

            <div id="myTabContent" class="p-6">
                <!-- Details Tab -->
                <div class="p-4 rounded-lg" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Trip Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-700">Location</h4>
                            <p class="text-gray-600">{{ $destination->place }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700">Duration</h4>
                            <p class="text-gray-600">{{ $destination->time }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700">Transportation</h4>
                            <p class="text-gray-600">{{ $destination->transportation }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700">Accommodation</h4>
                            <p class="text-gray-600">{{ $destination->accommodation }}</p>
                        </div>
                    </div>
                </div>

                <!-- Itinerary Tab -->
                <div class="hidden p-4 rounded-lg" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Detailed Itinerary</h3>
                    <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                        @foreach(explode("\n\n", $destination->itinerary) as $day)
                            @if(trim($day))
                                <div class="itinerary-day">
                                    {!! nl2br(e(trim($day))) !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Inclusion Tab -->
                <div class="hidden p-4 rounded-lg" id="inclusion" role="tabpanel" aria-labelledby="inclusion-tab">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">What's Included & Excluded</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Include -->
                        <div>
                            <h4 class="font-semibold text-green-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Included
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode("\n", $destination->include) as $item)
                                    @if(trim($item))
                                        <li class="text-gray-700 flex items-center">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                            {{ trim($item) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <!-- Exclude -->
                        <div>
                            <h4 class="font-semibold text-red-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Not Included
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode("\n", $destination->exclude) as $item)
                                    @if(trim($item))
                                        <li class="text-gray-700 flex items-center">
                                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                            {{ trim($item) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activities & Facilities -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Activities & Facilities</h3>
            <div class="flex flex-wrap gap-3">
                @foreach(explode(',', $destination->activities) as $activity)
                    @if(trim($activity))
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-4 py-2 rounded-full">
                            {{ trim($activity) }}
                        </span>
                    @endif
                @endforeach
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700">Meals</h4>
                    <p class="text-gray-600">{{ $destination->consumption }}</p>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700">Pickup Points</h4>
                    <p class="text-gray-600">
                        @foreach(json_decode($destination->pickup_points, true) ?? [$destination->pickup_points] as $point)
                            {{ trim($point) }}@unless($loop->last), @endunless
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA Booking -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-8 py-10 md:flex md:items-center md:justify-between">
                <div>
                    <h3 class="text-2xl font-bold">Ready to Book This Trip?</h3>
                    <p class="text-blue-100 mt-2">Secure your spot now and start your adventure.</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="#" onclick="alert('Booking feature coming soon!')"
                        class="inline-flex items-center px-8 py-3 text-lg font-medium bg-white text-blue-700 rounded-lg hover:bg-gray-100 transition">
                        Book Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @include('components.client.footer')
@endsection