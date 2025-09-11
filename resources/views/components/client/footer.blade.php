<footer class="footer text-white p-8 bg-white">
    <div class="bg-primary rounded-xl">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-8 gap-8 items-start">

                <!-- Column 1: Logo and Description -->
                <div class="lg:col-span-2 flex flex-col text-left">
                    <!-- Logo Section -->
                    <div class="logo-container">
                        <div class="w-24 rounded-lg flex items-center justify-center mr-3 mb-3">
                            <img src="{{ optional($profiles)->website_logo_light ? asset('storage/' . optional($profiles)->website_logo_light) : asset('assets/images/logo/logo-white.png') }}" alt="Septem Tour Logo">
                        </div>
                        <div class="mb-3">
                            <p class="text-blue-100 text-sm">Travel & Tour Agency</p>
                        </div>
                    </div>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Welcome to {{ optional($profiles)->website_name ?? "Septem Tour" }}! We provide the
                        best travel and tour
                        services to make
                        your journey
                        unforgettable. From local trips to international adventures, we are here to guide you every step
                        of the way.
                    </p>

                    <!-- Social Media -->
                    <div class="flex gap-x-4 mb-6">
                        <a href="{{ optional($profiles)->instagram_link }}"
                            class="social-icon w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20"
                            target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ optional($profiles)->facebook_link }}"
                            class="social-icon w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20"
                            target="_blank">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>

                </div>



                <!-- Column 3: Resources -->
                <div class="flex flex-col items-start">
                    <div class="mb-4">
                        <span
                            class="text-sm text-white font-semibold uppercase tracking-wider border-b-2 border-white/30 pb-1">Resources
                            & Service</span>
                    </div>
                    <ul class="space-y-3">
                        <li><a href="{{ route('index') }}" class="footer-link text-blue-100 hover:text-white flex items-center"><i
                                    class="fas fa-arrow-right text-xs mr-2"></i>Home</a></li>
                        <li><a href="{{ route('destination.index') }}" class="footer-link text-blue-100 hover:text-white flex items-center"><i
                                    class="fas fa-arrow-right text-xs mr-2"></i>Destination</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="footer-link text-blue-100 hover:text-white flex items-center"><i
                                    class="fas fa-arrow-right text-xs mr-2"></i>Gallery</a></li>
                        <li><a href="{{ route('about') }}" class="footer-link text-blue-100 hover:text-white flex items-center"><i
                                    class="fas fa-arrow-right text-xs mr-2"></i>About Us</a></li>
                        <li><a href="{{ route('faq') }}" class="footer-link text-blue-100 hover:text-white flex items-center"><i
                                    class="fas fa-arrow-right text-xs mr-2"></i>FAQs</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact -->
                <div class="flex flex-col items-start">
                    <div class="mb-4">
                        <span
                            class="text-sm text-white font-semibold uppercase tracking-wider border-b-2 border-white/30 pb-1">Contact
                            Us</span>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-white mt-1 mr-3"></i>
                            <span class="text-blue-100">{{ optional($profiles)->address ?? "Jl. Batubara 12 A, Kel. Purwantoro, Kec. Blimbing. Malang - Jawa
                                Timur 65122" }}
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-white mt-1 mr-3"></i>
                            <span
                                class="text-blue-100">{{ optional($profiles)->phone_number ?? "0812-2000-5276" }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-white mt-1 mr-3"></i>
                            <span class="text-blue-100">{{ optional($profiles)->contact_email ??
                                "support@septemtour.com" }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-white mt-1 mr-3"></i>
                            <span
                                class="text-blue-100">{{ optional($profiles)->operating_hours ?? "Mon - Sunday: 9:00 AM - 6:00 PM"}}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider my-10"></div>

            <!-- Bottom Footer -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <span class="text-sm text-blue-100">© 2025 {{ optional($profiles)->website_name ?? "Septem Tour"}}.
                        All rights reserved.</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-100 hover:text-white text-sm">Privacy Policy</a>
                    <a href="#" class="text-blue-100 hover:text-white text-sm">Terms of Service</a>
                    <a href="#" class="text-blue-100 hover:text-white text-sm">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>