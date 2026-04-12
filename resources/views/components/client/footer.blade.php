<footer class="footer text-white p-8">
    <div class="bg-primary rounded-2xl overflow-hidden shadow-xl">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-8 gap-8 items-start">

                {{-- KOLOM 1: LOGO & DESKRIPSI --}}
                <div class="lg:col-span-2 flex flex-col text-left">
                    <div class="logo-container mb-4">
                        <img 
                            src="{{ optional($profiles)->website_logo_light ? asset('storage/' . optional($profiles)->website_logo_light) : asset('assets/images/logo/logo-white.png') }}" 
                            alt="GOING TO THE JAVA Logo"
                            class="h-10 object-contain max-w-[160px]"
                        >
                        <p class="text-blue-100 text-sm mt-2">
                            @translate('Agen Perjalanan & Wisata')
                        </p>
                    </div>

                    <p class="text-blue-100 mb-6 leading-relaxed">
                        @translate('Selamat datang di') {{ optional($profiles)->website_name ?? "GOING TO THE JAVA" }}! 
                        @translate('Kami menyediakan layanan perjalanan dan wisata terbaik untuk membuat perjalanan Anda tak terlupakan. Dari perjalanan lokal hingga petualangan internasional, kami ada untuk Anda — cepat, aman, dan ramah.')
                    </p>

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
                        <a href="https://www.facebook.com/share/1FroC8sWtd/?mibextid=wwXIfr" target="_blank"
                           class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all duration-300"
                           aria-label="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>

                {{-- KOLOM 2: MENU NAVIGASI --}}
                <div class="flex flex-col items-start">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white border-b border-white/30 pb-1 mb-4">
                        @translate('Sumber Daya & Layanan')
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('index') }}" class="text-blue-100 hover:text-white flex items-center group">
                                <i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i> 
                                @translate('Beranda')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('destination.index') }}" class="text-blue-100 hover:text-white flex items-center group">
                                <i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> 
                                @translate('Destinasi')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usercar.index') }}" class="text-blue-100 hover:text-white flex items-center group">
                                <i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> 
                                @translate('Daftar Mobil')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gallery.index') }}" class="text-blue-100 hover:text-white flex items-center group">
                                <i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> 
                                @translate('Galeri')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="text-blue-100 hover:text-white flex items-center group">
                                <i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> 
                                @translate('Tentang Kami')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="text-blue-100 hover:text-white flex items-center group">
                                <i class="fas fa-arrow-right text-xs mr-2 opacity-0 group-hover:opacity-100"></i> 
                                @translate('FAQ')
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- KOLOM 3: KONTAK --}}
                <div class="flex flex-col items-start">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white border-b border-white/30 pb-1 mb-4">
                        @translate('Hubungi Kami')
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-white mt-1 mr-3 text-sm"></i>
                            {{-- Alamat biasanya dibiarkan apa adanya, tapi tetap dibungkus translate jika perlu --}}
                            <span class="text-blue-100 text-sm">
                                @translate(optional($profiles)->address ?? "Jl. Slamet Temboro No.70, Cemorokandang, Kec. Kedungkandang, Kota Malang, Jawa Timur 65122")
                            </span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-white mt-1 mr-3 text-sm flex-shrink-0"></i>
                            <div class="flex flex-col space-y-1">
                                
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', optional($profiles)->phone_number ?? '6281220005276') }}" target="_blank" class="text-blue-100 hover:text-white text-sm">
                                    {{ optional($profiles)->phone_number ?? "+62 812-2000-5276" }}
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-white mt-1 mr-3 text-sm"></i>
                            <a href="mailto:{{ optional($profiles)->contact_email ?? 'support@goingtothejava.com' }}" class="text-blue-100 hover:text-white text-sm">
                                {{ optional($profiles)->contact_email ?? "support@goingtothejava.com" }}
                            </a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-white mt-1 mr-3 text-sm"></i>
                            {{-- Jam Operasional --}}
                            <span class="text-blue-100 text-sm">
                                @translate(optional($profiles)->operating_hours ?? "Senin - Minggu: 07:30 - 20:00")
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

            <hr class="border-white/20 my-10">

            {{-- FOOTER BAWAH: COPYRIGHT --}}
            <div class="flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="text-blue-100 mb-4 md:mb-0">
                    © 2025 {{ optional($profiles)->website_name ?? "GOING TO THE JAVA" }}. @translate('By CV. NENNIS')
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-100 hover:text-white transition-colors">@translate('Kebijakan Privasi')</a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors">@translate('Syarat Layanan')</a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors">@translate('Kebijakan Cookie')</a>
                </div>
            </div>
        </div>
    </div>
</footer>