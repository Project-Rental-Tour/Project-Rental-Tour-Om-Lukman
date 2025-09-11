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
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <!-- Header Section -->
    <br>
    <br>
    <section class="max-w-7xl mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4 animate-fade-up">
            About Us
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-up">
            We are passionate about creating unforgettable travel experiences. 
            With years of expertise, we connect travelers with the beauty, culture, and adventure of Indonesia and beyond.
        </p>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Image -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image + Contact -->
                <div class="space-y-8">
                    <div class="rounded-2xl overflow-hidden shadow-xl group">
                        <img loading="lazy"
                            src="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?auto=format&fit=crop&w=800&q=80"
                            alt="Our Team - Travel Experts"
                            class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>

                    <!-- Contact Info Card -->
                    <div class="bg-primary-opacity p-8 rounded-2xl shadow-lg border border-primary/20">
                        <h3 class="text-2xl font-bold text-white mb-4">Contact Us</h3>
                        <p class="text-gray-200 text-sm mb-6">
                            Whether you have questions about our services, need support, or want to share your feedback, 
                            our dedicated team is here to assist you every step of the way.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white">Email</h4>
                                    <p class="text-gray-200 text-sm">septemtour@gmail.com</p>
                                </div>
                            </div>

                            <!-- Website -->
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-globe text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white">Website</h4>
                                    <p class="text-gray-200 text-sm">www.septemtourandtravel.com</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white">Phone</h4>
                                    <p class="text-gray-200 text-sm">+62 812 2000 5276</p>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white">Location</h4>
                                    <p class="text-gray-200 text-sm">Malang - Jatim</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Text Content -->
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-gray-800 animate-fade-up">
                        Our Story & Mission
                    </h2>
                    <p class="text-gray-600 leading-relaxed animate-fade-up">
                        Founded in 2010, our journey began with a simple dream: to make meaningful travel accessible to everyone. 
                        Today, we've helped thousands of travelers explore hidden gems, experience local cultures, and create memories that last a lifetime.
                    </p>
                    <p class="text-gray-600 leading-relaxed animate-fade-up">
                        We believe travel is more than just visiting places — it's about connection, discovery, and transformation. 
                        That’s why every trip we design is crafted with care, sustainability, and authenticity in mind.
                    </p>

                    <!-- Values -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg animate-fade-up">
                            <h3 class="font-semibold text-primary">Adventure</h3>
                            <p class="text-sm text-gray-600">We seek the extraordinary in every journey.</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg animate-fade-up">
                            <h3 class="font-semibold text-green-700">Sustainability</h3>
                            <p class="text-sm text-gray-600">We travel responsibly and support local communities.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-800 animate-fade-up">
                    Our Story & Mission
                </h2>
                <p class="text-gray-600 leading-relaxed animate-fade-up">
                    Founded in 2010, our journey began with a simple dream: to make meaningful travel accessible to everyone. 
                    Today, we've helped thousands of travelers explore hidden gems, experience local cultures, and create memories that last a lifetime.
                </p>
                <p class="text-gray-600 leading-relaxed animate-fade-up">
                    We believe travel is more than just visiting places — it's about connection, discovery, and transformation. 
                    That’s why every trip we design is crafted with care, sustainability, and authenticity in mind.
                </p>

                <!-- Values -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <div class="bg-blue-50 p-4 rounded-lg animate-fade-up">
                        <h3 class="font-semibold text-primary">Adventure</h3>
                        <p class="text-sm text-gray-600">We seek the extraordinary in every journey.</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg animate-fade-up">
                        <h3 class="font-semibold text-green-700">Sustainability</h3>
                        <p class="text-sm text-gray-600">We travel responsibly and support local communities.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="animate-fade-up">
                <h3 class="text-4xl font-bold text-primary">15K+</h3>
                <p class="text-gray-600 mt-2">Happy Travelers</p>
            </div>
            <div class="animate-fade-up">
                <h3 class="text-4xl font-bold text-primary">50+</h3>
                <p class="text-gray-600 mt-2">Destinations Covered</p>
            </div>
            <div class="animate-fade-up">
                <h3 class="text-4xl font-bold text-primary">14 Years</h3>
                <p class="text-gray-600 mt-2">Of Trusted Service</p>
            </div>
        </div>
    </section>

    <!-- WhatsApp Floating Button -->
    <a 
        href="https://wa.me/6281220005276"
        target="_blank"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-600 text-white px-5 py-4 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-3 group"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
    @endpush
@endsection