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
    <br>
    <br>
    <section class="max-w-7xl mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4 animate-fade-up">
            Our Travel Gallery
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-up">
            Every photo tells a story. Explore breathtaking moments from our journeys around the world — 
            from hidden villages to majestic landscapes and joyful traveler experiences.
        </p>
    </section>

    <!-- Masonry Gallery -->
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="columns-2 md:columns-4 gap-4 space-y-6">
            @foreach ($galleries as $gallery)
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
    </section>

    <!-- WhatsApp Floating Button -->
    <a 
        href="https://wa.me/6281220005276?text=Halo%20Septem%20Tour!%20Saya%20ingin%20bertanya%20tentang%3A%0A-%20Tujuan%3A%20%5BIsi%20di%20sini%5D%0A-%20Jumlah%20orang%3A%20%5BIsi%20di%20sini%5D%0A-%20Tanggal%20perjalanan%3A%20%5BIsi%20di%20sini%5D%0A-%20Lainnya%3A%20%5BTulis%20pertanyaanmu%5D" 
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