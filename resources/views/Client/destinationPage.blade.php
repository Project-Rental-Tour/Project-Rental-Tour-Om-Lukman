@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .bg-primary { background-color: #799eff; }
        .text-primary { color: #799eff; }
        .bg-primary-opacity { background-color: rgba(121, 158, 255, 0.05); }
        .text-white { color: #ffffff; }
        .text-green { color: #10b981; }

        .animate-fade-up {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeUp 0.6s ease-out forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up:nth-child(1) { animation-delay: 0.1s; }
        .animate-fade-up:nth-child(2) { animation-delay: 0.2s; }
        .animate-fade-up:nth-child(3) { animation-delay: 0.3s; }
        .animate-fade-up:nth-child(4) { animation-delay: 0.4s; }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <!-- Header Section -->
    <br>
    <br>
    <section class="max-w-7xl mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4 animate-fade-up">
            Explore Our Travel Destinations
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-up">
            Discover handcrafted travel packages filled with adventure, culture, and unforgettable moments.
            From serene beaches to mountain treks, we’ve got your next journey covered.
        </p>
    </section>

    <!-- Destinations Grid -->
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Loop Destinasi -->
            @foreach ($destinations->take(2) as $destination)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 animate-fade-up h-full flex flex-col">
                    <!-- Gambar -->
                    <div class="relative h-48 overflow-hidden">
                        <img loading="lazy" src="{{ asset($destination->destination_photo) }}"
                            alt="{{ $destination->name_package }}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <div class="absolute inset-0 bg-black/60 opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Konten -->
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $destination->name_package }}</h3>
                        <div class="flex items-center text-gray-600 mb-3 text-sm">
                            <i class="fas fa-map-marker-alt mr-1 text-primary"></i>
                            <span>{{ $destination->place }}</span>
                        </div>

                        <!-- Aktivitas -->
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach(explode(',', $destination->activities) as $activity)
                                @if(trim($activity))
                                    <span class="bg-blue-50 text-primary px-2 py-0.5 rounded-full text-xs font-medium border border-primary/30">
                                        {{ trim($activity) }}
                                    </span>
                                @endif
                            @endforeach
                        </div>

                        <!-- Tombol Book Now -->
                        <a href="{{ route('destination.show', $destination->slug) }}"
                            class="w-full mt-auto text-white py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105 flex items-center justify-center bg-primary hover:bg-blue-600">
                            <span>Book Now</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Custom Trip Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 animate-fade-up cursor-pointer group"
                 onclick="window.location='{{ route('booking.custom') }}'">
                <!-- Gambar dengan overlay -->
                <div class="relative h-48 overflow-hidden">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80"
                         alt="Customize Your Trip"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-magic text-3xl mb-1"></i>
                            <h3 class="text-lg font-bold">Design Your Trip</h3>
                        </div>
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Create Your Own Adventure</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        No package fits? Tell us your dream destination and we'll create a custom experience.
                    </p>

                    <!-- Fitur Custom -->
                    <div class="flex flex-wrap gap-1 mb-4 text-xs">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full flex items-center">
                            <i class="fas fa-pen mr-1"></i> Fully Custom
                        </span>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full flex items-center">
                            <i class="fas fa-calendar mr-1"></i> Any Date
                        </span>
                    </div>

                    <!-- Tombol Customize Now -->
                    <button class="w-full text-white py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105 flex items-center justify-center"
                            style="background-color: #ffbc4c;">
                        <span>Customize Now</span>
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </button>
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
    @endpush
@endsection