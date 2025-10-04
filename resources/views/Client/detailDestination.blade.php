@extends('_layouts.user')

@section('head')
<style>
.text-muted {
    color: #64748b;
}

 .header-gap {
        margin-top: 3rem; /* ~48px */
    }
</style>
@endsection

@section('content')
    @include('components.client.navbar')

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white h-96" id="jumbotron">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <img loading="lazy" src="{{ asset($destination->destination_photo) }}" alt="{{ $destination->name_package }}"
            class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl">
                    <span class="bg-blue-600 text-white text-sm px-3 py-1 rounded-full mb-4 inline-block">
                        {{ ucfirst($destination->category) }} Trip
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $destination->name_package }}</h1>
                    <p class="text-xl text-blue-200 mb-6">{{ $destination->place }} • {{ $destination->time }}</p>
                    <div class="flex flex-wrap items-center gap-6 text-lg">
                        <span class="font-bold text-yellow-300 text-2xl">
                            IDR.{{ number_format($destination->price, 0, ',', '.') }} <span
                                class="text-sm font-normal">/person</span>
                        </span>
                        <span class="bg-green-600 px-3 py-1 rounded-md text-sm">{{ ucfirst($destination->level) }}
                            Level</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-white py-4 shadow-sm sticky top-16 z-30">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li class="font-medium text-gray-900"><a href="{{route('index')}}">Home</a></li>
                <li class="text-gray-400">/</li>
                <li class="font-medium text-gray-900"><a href="{{route('destination.index')}}">Destinations</a></li>
                <li class="text-gray-400">/</li>
                <li class="font-medium text-gray-900">{{ $destination->name_package }}</li>
            </ol>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="container mx-auto px-6 py-12 space-y-12">
        <!-- Gallery + Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <img loading="lazy" src="{{ asset($destination->destination_photo) }}" alt="Main View"
                    class="w-full h-80 object-cover rounded-xl shadow-lg">
            </div>
            <div class="bg-blue-50 p-6 rounded-xl space-y-4">
                <h4 class="font-semibold text-lg text-gray-800">Description</h4>
                <div class="text-sm">{{$destination->description}}</div>
                <div class="pt-2">
                    <span class="text-xs text-gray-500">Based on {{ $destination->name_package }}</span>
                </div>
            </div>
        </div>

        <!-- Tabs -->
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

                    <li class="me-1" role="presentation">
                        <button
                            id="tour-tab"
                            data-tabs-target="#tour"
                            type="button"
                            role="tab"
                            aria-controls="tour"
                            aria-selected="false"
                            class="inline-block px-6 py-3 rounded-xl text-gray-700  transition-all duration-300 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-blue-100 font-semibold">
                            Tour Highlights
                        </button>
                    </li>

                    <!-- Tab 2: Facility -->
                    <li class="me-1" role="presentation">
                        <button
                            id="inclusion-tab"
                            data-tabs-target="#inclusion"
                            type="button"
                            role="tab"
                            aria-controls="inclusion"
                            aria-selected="false"
                            class="inline-block px-6 py-3 rounded-xl text-gray-700 transition-all duration-300 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-blue-100 font-semibold">
                            Facility
                        </button>
                    </li>

                    <!-- Tab 3: Itinerary -->
                    <li class="me-1" role="presentation">
                        <button
                            id="itinerary-tab"
                            data-tabs-target="#itinerary"
                            type="button"
                            role="tab"
                            aria-controls="itinerary"
                            aria-selected="false"
                            class="inline-block px-6 py-3 rounded-xl text-gray-700  transition-all duration-300 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-blue-100 font-semibold">
                            Itinerary
                        </button>
                    </li>

                    <li class="me-1" role="presentation">
                        <button
                            id="note-tab"
                            data-tabs-target="#note"
                            type="button"
                            role="tab"
                            aria-controls="note"
                            aria-selected="false"
                            class="inline-block px-6 py-3 rounded-xl text-gray-700  transition-all duration-300 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-blue-100 font-semibold">
                            Note
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tabs Content -->
            <div id="myTabContent" class="p-6">
                <!-- Details Tab -->
                <div class="block animate-fade-in" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">Trip Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Location</h4>
                            <p class="text-gray-800 text-base">{{ $destination->place }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Duration</h4>
                            <p class="text-gray-800">{{ $destination->time }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-1">Transportation</h4>
                            <p class="text-gray-800">{{ $destination->transportation }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-3">Accommodation</h4>
                             <p class="text-gray-800">{{ $destination->accommodation }}</p>
                        </div>
                        <!-- Pickup & Dropoff Points -->
                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-3">Pickup Points</h4>
                            <p class="text-gray-800">{{ $destination->pickup_points }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-3">Dropoff Points</h4>
                            <p class="text-gray-800">{{ $destination->dropoff_points }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tour Highlights Tab -->
                <div class="hidden animate-fade-in" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">Tour Highlights</h3>
                    <div class="flex flex-wrap gap-2">
                       <ul class="space-y-2">
                                @foreach(explode(',', $destination->activities) as $item)
                                    @if(trim($item))
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="w-2 h-2 bg-green-600 rounded-full mt-2 flex-shrink-0"></span>
                                            {{ trim($item) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                    </div>
                </div>

                <!-- Facility Tab -->
                <div class="hidden animate-fade-in" id="inclusion" role="tabpanel" aria-labelledby="inclusion-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Inclusions & Exclusions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Include -->
                        <div>
                            <h4 class="font-bold text-green-700 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                What's Included
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode('.', $destination->include) as $item)
                                    @if(trim($item))
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="w-2 h-2 bg-green-600 rounded-full mt-2 flex-shrink-0"></span>
                                            {{ trim($item) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <!-- Exclude -->
                        <div>
                            <h4 class="font-bold text-red-700 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Not Included
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode('.', $destination->exclude) as $item)
                                    @if(trim($item))
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="w-2 h-2 bg-red-600 rounded-full mt-2 flex-shrink-0"></span>
                                            {{ trim($item) }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Itinerary Tab -->
                <div class="hidden animate-fade-in" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Day-by-Day Itinerary</h3>
                    <div class="prose prose-gray max-w-none leading-relaxed space-y-3">
                        @php
                            $lines = explode("\n", $destination->itinerary);
                        @endphp
                        @foreach($lines as $line)
                            @if(trim($line))
                                <div class="flex items-start gap-2 py-1">
                                    {{-- <span class="font-semibold text-blue-600 min-w-[50px]">{{ trim($line, '. ') }}</span> --}}
                                    <span class="text-gray-700">{!! trim($line) !!}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="hidden animate-fade-in" id="note" role="tabpanel" aria-labelledby="note-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">Note</h3>
                    <div class="flex flex-wrap gap-2">
                       <ul class="space-y-2">
                            @php
                                $lines = explode("\n", $destination->note);
                            @endphp
                            @foreach($lines as $line)
                                @if(trim($line))
                                    <div class="flex items-start gap-2 py-1">
                                        {{-- <span class="font-semibold text-blue-600 min-w-[50px]">{{ trim($line, '. ') }}</span> --}}
                                        <span class="text-gray-700">{!! trim($line) !!}</span>
                                    </div>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activities -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Gallery {{ $destination->name_package }}</h3>
            <div class="columns-2 md:columns-4 gap-4 space-y-6">

                @forelse($relatedGalleries as $gallery)
                <div class="relative break-inside-avoid group rounded-lg overflow-hidden animate-fade-up">
                    <img loading="lazy" 
                        src="{{ asset($gallery->gallery_photo) }}" 
                        alt="{{ $gallery->title }}"
                        class="w-full h-auto object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
                    />
                    <!-- Overlay saat hover -->
                    <div class="absolute top-1/2 left-1/2 
                                bg-black/80 text-white text-xs md:text-sm font-medium 
                                px-2 py-1 rounded-md 
                                opacity-0 group-hover:opacity-100 
                                transition-opacity duration-300 
                                whitespace-nowrap uppercase
                                transform -translate-x-1/2 -translate-y-1/2">
                        {{ $gallery->title }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Faq --}}
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Frequently Asked Questions</h3>
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
                            Yes. Additional charges apply. Please contact us at <strong>goingtothejava@gmail.com</strong> or WhatsApp/Telegram: <strong>081220005276</strong>.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Booking -->
        <div class="bg-yellow-400 text-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-8 py-10 md:flex md:items-center md:justify-between">
                <div>
                    <h3 class="text-2xl font-bold">Ready to Book This Trip?</h3>
                    <p class="text-gray-100 mt-2">Secure your spot now and start your adventure.</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="{{ route('booking.regular.form', $destination->slug) }}"
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

    <a 
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20get%20some%20information%3A%0A-%20Destination%3A%20%5BEnter%20your%20preferred%20destination%5D%0A-%20Number%20of%20Travelers%3A%20%5BEnter%20number%5D%0A-%20Travel%20Date%3A%20%5BEnter%20date%5D%0A-%20Email%3A%20%5BEnter%20your%20email%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
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