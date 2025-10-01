@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .bg-primary { background-color: #799eff; }
        .text-primary { color: #799eff; }
        .bg-primary-opacity { background-color: rgba(121, 158, 255, 0.05);}
        .text-white { color: #ffffff; }
        .text-green { color: #10b981; }

        .columns-2 img,
        .columns-4 img {
            height: auto;
            display: block;
        }

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
    <section id="jumbotron" class="relative bg-gray-900 text-white h-96 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/50 to-purple-900/50"></div>
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <img loading="lazy" src="{{ asset('assets/images/bg_header_gallery.png') }}" 
            alt="Car Fleet" class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl animate-fade-up">
                    <br>
                    <br>
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Our Travel Gallery</h1>
                    <p class="text-xl text-blue-200 mb-8">Every photo tells a story. Explore breathtaking moments from our journeys around the world — 
            from hidden villages to majestic landscapes and joyful traveler experiences.</p>
                    
                    <!-- Quick Stats -->
                    
                </div>
            </div>
        </div>
    </section>
    

    <!-- Masonry Gallery -->
    <section class="max-w-7xl mx-auto px-6 pb-24 mt-10">
        <div class="columns-2 md:columns-4 gap-4 space-y-6">
            @foreach ($galleries as $gallery)
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
    </section>

    <!-- WhatsApp Floating Button -->
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

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
    @endpush
@endsection