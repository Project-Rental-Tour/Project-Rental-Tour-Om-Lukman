<footer class="footer text-white p-8">
    <div class="bg-primary rounded-2xl overflow-hidden shadow-xl">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-8 gap-8 items-start">

                <!-- Column 1: Logo and Description -->
                <div class="lg:col-span-2 flex flex-col text-left">
                    <!-- Logo Section -->
                    <div class="logo-container mb-4">
                        <img 
                            src="{{ optional($profiles)->website_logo_light ? asset('storage/' . optional($profiles)->website_logo_light) : asset('assets/images/logo/logo-white.png') }}" 
                            alt="Septem Tour Logo"
                            class="h-10 object-contain max-w-[160px]"
                        >
                        <p class="text-blue-100 text-sm mt-2">Travel & Tour Agency</p>
                    </div>

                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Welcome to {{ optional($profiles)->website_name ?? "Septem Tour" }}! We provide the best travel and tour services to make your journey unforgettable. From local trips to international adventures, we’re here for you — fast, secure, and friendly.
                    </p>

                    <!-- Social Media -->
                    <div class="flex gap-x-4 mb-6">
                        <a href="{{ optional($profiles)->instagram_link }}" target="_blank"
                           class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all duration-300"
                           aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ optional($profiles)->facebook_link }}" target="_blank"
                           class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all duration-300"
                           aria-label="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Resources -->
                <div class="flex flex-col items-start">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white border-b border-white/30 pb-1 mb-4">
                        Resources & Services
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('index') }}" class="text-blue-100 hover:text-white flex items-center group"><i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> Home</a></li>
                        <li><a href="{{ route('destination.index') }}" class="text-blue-100 hover:text-white flex items-center group"><i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> Destination</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="text-blue-100 hover:text-white flex items-center group"><i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> Gallery</a></li>
                        <li><a href="{{ route('about') }}" class="text-blue-100 hover:text-white flex items-center group"><i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> About Us</a></li>
                        <li><a href="{{ route('faq') }}" class="text-blue-100 hover:text-white flex items-center group"><i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> FAQs</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="flex flex-col items-start">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white border-b border-white/30 pb-1 mb-4">
                        Contact Us
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-white mt-1 mr-3 text-sm"></i>
                            <span class="text-blue-100 text-sm">{{ optional($profiles)->address ?? "Jl. Batubara 12 A, Kel. Purwantoro, Kec. Blimbing, Malang - Jawa Timur 65122" }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-white mt-1 mr-3 text-sm"></i>
                            <a href="https://wa.me/6281220005276" target="_blank" class="text-blue-100 hover:text-white text-sm">
                                {{ optional($profiles)->phone_number ?? "+62 812-2000-5276" }}
                            </a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-white mt-1 mr-3 text-sm"></i>
                            <a href="mailto:{{ optional($profiles)->contact_email ?? 'support@septemtour.com' }}" class="text-blue-100 hover:text-white text-sm">
                                {{ optional($profiles)->contact_email ?? "support@septemtour.com" }}
                            </a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-white mt-1 mr-3 text-sm"></i>
                            <span class="text-blue-100 text-sm">{{ optional($profiles)->operating_hours ?? "Mon - Sunday: 9:00 AM - 6:00 PM" }}</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Divider -->
            <hr class="border-white/20 my-10">

            <!-- Bottom Footer -->
            <div class="flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="text-blue-100 mb-4 md:mb-0">
                    © 2025 {{ optional($profiles)->website_name ?? "Septem Tour" }}. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-100 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>