@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /* Primary Colors */
        .bg-primary { background-color: #799eff; }
        .text-primary { color: #799eff; }
        .bg-primary-opacity { background-color: rgba(121, 158, 255, 0.05); }
        .text-white { color: #ffffff; }
        .text-green { color: #10b981; }

        /* Smooth Fade Up Animation */
        .animate-fade-up {
            opacity: 0;
            transform: translateY(15px);
            animation: fadeUp 0.8s ease-out forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Sequential Animation Delays */
        .animate-fade-up:nth-child(1) { animation-delay: 0.2s; }
        .animate-fade-up:nth-child(2) { animation-delay: 0.4s; }
        .animate-fade-up:nth-child(3) { animation-delay: 0.6s; }
        .animate-fade-up:nth-child(4) { animation-delay: 0.8s; }

        /* Hover Scale Effect */
        .group-hover-scale img {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .group-hover-scale:hover img {
            transform: scale(1.05);
        }

        /* Contact Card Hover Effect */
        .contact-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .contact-card:hover {
            transform: translateY(-6px);
            box-shadow: 
                0 25px 35px -10px rgba(0, 0, 0, 0.15),
                0 12px 15px -5px rgba(0, 0, 0, 0.08);
        }

        /* WhatsApp Button Float Animation */
        

        /* Gradient Background Overlay */
        .gradient-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.6) 100%);
            pointer-events: none;
        }

        /* Subtle Border Radius & Shadows */
        .rounded-xl { border-radius: 1rem; }
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }

        /* Stats Card Hover */
        .stat-card:hover {
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }

        /* Uniform Contact Item Style */
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .contact-item:hover {
            background-color: #ebf5ff;
            border-color: #799eff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .contact-icon {
            min-width: 20%;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1rem;
        }
        .icon-email,
        .icon-website,
        .icon-location {
            background-color: #f97316; /* Orange */
        }
        .icon-whatsapp {
            background-color: #10b981; /* Green */
        }
        .contact-info h4 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.125rem;
        }
        .contact-info p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section id="jumbotron" class="relative bg-gray-900 text-white h-96 overflow-hidden mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/50 to-purple-900/50"></div>
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <img loading="lazy" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1920&q=80" 
            alt="Car Fleet" class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl animate-fade-up">
                    <br>
                    <br>
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">About Us</h1>
                    <p class="text-xl text-blue-200 mb-8"> We are passionate about creating unforgettable travel experiences. 
            With years of expertise, we connect travelers with the beauty, culture, and adventure of Indonesia and beyond.</p>
                    
                    <!-- Quick Stats -->
                    
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <!-- Left Column: Image & Contact -->
            <div class="space-y-10">
                <!-- Team Image with Overlay -->
                <div class="rounded-xl overflow-hidden shadow-xl group group-hover-scale relative h-80">
                    <img loading="lazy"
                         src="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?auto=format&fit=crop&q=80"
                         alt="Our Travel Expert Team"
                         class="w-full h-full object-cover transition-transform duration-700">
                    <div class="gradient-overlay"></div>
                    <div class="absolute inset-0 flex items-end justify-center p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <p class="text-white text-sm md:text-base text-center leading-relaxed bg-black/40 px-4 py-3 rounded-lg backdrop-blur-sm">
                            Our team is ready to make your dream trip come true — anytime, anywhere.
                        </p>
                    </div>
                </div>

                <!-- Contact Info Card -->
<!-- Contact Info Card -->
<div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 mt-6">
    <h3 class="text-2xl font-bold text-gray-800 mb-4">Contact Us</h3>
    <p class="text-gray-600 mb-6 leading-relaxed">
        Whether you have questions about our services, need support, or want to share your feedback, 
        our dedicated team is here to assist you every step of the way — fast, secure, and friendly.
    </p>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Email -->
        <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl border border-blue-100 hover:bg-blue-100 transition">
            <div class="bg-orange-500 text-white px-2 py-1 rounded-lg">
                <i class="fas fa-envelope text-sm"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-sm">Email</h4>
                <a href="mailto:goingtothejava@gmail.com" class="text-gray-600 text-sm hover:text-blue-700">
                    goingtothejava@gmail.com
                </a>
            </div>
        </div>

        <!-- Website -->
        <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl border border-blue-100 hover:bg-blue-100 transition">
            <div class="bg-orange-500 text-white px-2 py-1 rounded-lg">
                <i class="fas fa-globe text-sm"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-sm">Website</h4>
                <a href="https://www.goingtothejava.com" target="_blank" class="text-gray-600 text-sm hover:text-blue-700">
                    www.goingtothejava.com
                </a>
            </div>
        </div>

        <!-- WhatsApp (Dua Nomor) -->
        <div class="flex items-start gap-3 p-4 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition">
            <div class="bg-green-600 text-white px-2 py-1 rounded-lg">
                <i class="fab fa-whatsapp text-sm"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-sm">WhatsApp</h4>
                <div class="space-y-1 mt-1">
                    <a href="https://wa.me/6281220005276" target="_blank" class="block text-gray-600 text-sm hover:text-green-700">
                        +62 812 2000 5276
                    </a>
                    <a href="https://wa.me/6281217006076" target="_blank" class="block text-gray-600 text-sm hover:text-green-700">
                        +62 812 1700 6076
                    </a>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl border border-blue-100 hover:bg-blue-100 transition">
            <div class="bg-orange-500 text-white px-2 py-1 rounded-lg">
                <i class="fas fa-map-marker-alt text-sm"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-sm">Location</h4>
                <p class="text-gray-600 text-sm">
                    Malang, East Java, Indonesia
                </p>
            </div>
        </div>
    </div>
</div>
            </div>

            <!-- Right Column: Story & Mission -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-800 animate-fade-up">Our Story & Mission</h2>
                <p class="text-gray-600 leading-relaxed animate-fade-up">
                    Founded in 2010, our journey began with a simple dream: to make meaningful travel accessible to everyone. 
                    Today, we've helped over 15,000 travelers explore hidden gems, experience local cultures, and create memories that last a lifetime.
                </p>
                <p class="text-gray-600 leading-relaxed animate-fade-up">
                    We believe travel is more than just visiting places — it's about connection, discovery, and transformation. 
                    That’s why every trip we design is crafted with care, sustainability, and authenticity in mind.
                </p>

                <!-- Core Values -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <div class="bg-blue-50 border border-blue-200 p-5 rounded-lg animate-fade-up hover:shadow-md transition-shadow">
                        <h3 class="font-semibold text-primary flex items-center">
                            <i class="fas fa-mountain mr-2"></i> Adventure
                        </h3>
                        <p class="text-sm text-gray-600">We seek the extraordinary in every journey.</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 p-5 rounded-lg animate-fade-up hover:shadow-md transition-shadow">
                        <h3 class="font-semibold text-green-700 flex items-center">
                            <i class="fas fa-leaf mr-2"></i> Sustainability
                        </h3>
                        <p class="text-sm text-gray-600">We travel responsibly and support local communities.</p>
                    </div>
                </div>

                <!-- Secure Support Section using WhatsApp values -->
                
            </div>
        </div>

        <!-- Stats Section -->
        
    </section>

    <!-- WhatsApp Floating Button -->
    <a 
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20get%20some%20information%3A%0A-%20Destination%3A%20%5BEnter%20your%20preferred%20destination%5D%0A-%20Number%20of%20Travelers%3A%20%5BEnter%20number%5D%0A-%20Travel%20Date%3A%20%5BEnter%20date%5D%0A-%20Email%3A%20%5BEnter%20your%20email%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
        target="_blank"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 pyx-2 py-1 rounded-lg shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group animate-bounce-slow"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium whitespace-nowrap">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
        
    @endpush
@endsection