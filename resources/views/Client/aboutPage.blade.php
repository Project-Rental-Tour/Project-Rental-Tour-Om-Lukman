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

    <!-- Header Section -->
    <br>
    <br>
    <section class="max-w-4xl mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-6 animate-fade-up">
            About Us
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-up leading-relaxed">
            We are passionate about creating unforgettable travel experiences. 
            With years of expertise, we connect travelers with the beauty, culture, and adventure of Indonesia and beyond.
        </p>
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
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 mt-8 rounded-2xl shadow-lg border border-blue-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Contact Us</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Whether you have questions about our services, need support, or want to share your feedback, 
                        our dedicated team is here to assist you every step of the way — fast, secure, and friendly.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="contact-item">
                            <div class="contact-icon icon-email text-white">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-info">
                                <h4>Email</h4>
                                <p>septemtour@gmail.com</p>
                            </div>
                        </div>

                        <!-- Website -->
                        <div class="contact-item">
                            <div class="contact-icon icon-website text-white">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="contact-info">
                                <h4>Website</h4>
                                <p>www.septemtour.com</p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="contact-item">
                            <div class="contact-icon icon-whatsapp text-white">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="contact-info">
                                <h4>WhatsApp</h4>
                                <p>+62 812 2000 5276</p>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="contact-item">
                            <div class="contact-icon icon-location text-white">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-info">
                                <h4>Location</h4>
                                <p>Malang, East Java, Indonesia</p>
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
                <div class="mt-8 bg-white p-6 rounded-xl border border-gray-200 shadow-sm animate-fade-up">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-shield-alt text-primary mr-2"></i> Why Choose WhatsApp?
                    </h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i> <strong>End-to-end encryption:</strong> Your messages stay private.</li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i> <strong>Free worldwide messaging & calls:</strong> No extra charges.</li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i> <strong>Fast response:</strong> Voice notes, stickers, files, and more.</li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i> <strong>Status updates:</strong> Share photos, videos, and moments securely.</li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i> <strong>Group chats:</strong> Easy coordination for group tours.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="stat-card animate-fade-up">
                <h3 class="text-4xl font-bold text-primary">15K+</h3>
                <p class="text-gray-600 mt-2 font-medium">Happy Travelers</p>
            </div>
            <div class="stat-card animate-fade-up">
                <h3 class="text-4xl font-bold text-primary">50+</h3>
                <p class="text-gray-600 mt-2 font-medium">Destinations Covered</p>
            </div>
            <div class="stat-card animate-fade-up">
                <h3 class="text-4xl font-bold text-primary">14 Years</h3>
                <p class="text-gray-600 mt-2 font-medium">Of Trusted Service</p>
            </div>
        </div>
    </section>

    <!-- WhatsApp Floating Button -->
 <a 
        href="https://wa.me/6281220005276" 
        target="_blank"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text text-white font-medium whitespace-nowrap ml-1 mt-0.5">Need Help ?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
        
    @endpush
@endsection