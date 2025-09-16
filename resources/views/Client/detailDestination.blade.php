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
                            Rp.{{ number_format($destination->price, 0, ',', '.') }} <span
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                                <h4 class="font-semibold text-emerald-800 text-sm">Pickup Points</h4>
                                <p class="text-sm text-emerald-700 mt-1">{{ $pickupText }}</p>
                            </div>

                            <div class="bg-rose-50 border border-rose-200 rounded-lg p-4">
                                <h4 class="font-semibold text-rose-800 text-sm">Dropoff Points</h4>
                                <p class="text-sm text-rose-700 mt-1">{{ $dropoffText }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tour Highlights Tab -->
                <div class="hidden animate-fade-in" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">Tour Highlights</h3>
                    <div class="flex flex-wrap gap-2">
                       <ul class="space-y-2">
                                @foreach(explode('.', $destination->activities) as $item)
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
                                @foreach(explode('.', $destination->note) as $item)
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
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <p class="text-white text-sm font-medium px-3 text-center">{{ $gallery->title }}</p>
                        </div>
                    </div>
                @endforeach
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
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20get%20some%20information%3A%0A-%20Destination%3A%20%5BEnter%20your%20preferred%20destination%5D%0A-%20Number%20of%20Travelers%3A%20%5BEnter%20number%5D%0A-%20Travel%20Date%3A%20%5BEnter%20date%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
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