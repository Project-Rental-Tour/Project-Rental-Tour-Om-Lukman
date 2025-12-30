@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- UNIFIED FONT TO POPPINS ONLY --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/js/all.min.js') }}"></script>

    <style>
        /* --- Premium Blue Ocean Theme Configuration --- */
        :root {
            --color-primary: #003366;   /* Deep Ocean Navy */
            --color-primary-light: #004080;
            --color-secondary: #00b4d8; /* Pacific Cyan/Sky Blue */
            --color-secondary-light: #90e0ef;
            --color-surface: #f4f8fb;   /* Very Light Blue/White */
            --color-text: #1e293b;
            --color-text-light: #64748b;
            font-family: 'Poppins', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--color-surface);
            color: var(--color-text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* --- Noise Texture Overlay --- */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: multiply;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.02em;
        }
        
        .text-balance { text-wrap: balance; }

        /* --- Custom Utilities --- */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }
        .bg-surface { background-color: var(--color-surface) !important; }

        /* --- Components --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(0, 51, 102, 0.08);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
        }
        .btn-premium::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: 0.5s;
        }
        .btn-premium:hover::after { left: 100%; }
        .btn-premium:hover { box-shadow: 0 10px 25px -5px rgba(0, 51, 102, 0.4); transform: translateY(-2px); }

        /* --- Animations --- */
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .animate-fade-up {
            opacity: 0; transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        /* Form Styling */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--color-secondary);
            box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.1);
        }
        
        /* Checkbox Custom */
        input[type="checkbox"]:checked ~ div {
            background-color: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HERO SECTION --}}
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden bg-primary" id="jumbotron">
        <div class="absolute inset-0 z-0">
            <img loading="lazy" 
                src="{{ optional($profiles)->background_image ? asset(optional($profiles)->background_image) : asset('assets/images/jumbotron/background-jumbo.png') }}" 
                alt="Dream Travel Experience"
                class="w-full h-full object-cover object-center opacity-60 animate-float-slow">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-b from-[#003366]/70 via-[#003366]/30 to-[#003366]/60"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center pt-20">
            <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block animate-fade-up shadow-secondary/20">
                @translate('Personalized Journey')
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight font-serif animate-fade-up shadow-sm drop-shadow-md">
                @translate('Design Your') <span class="italic text-secondary">@translate('Dream Trip')</span>
            </h1>
            <p class="text-lg md:text-xl text-white/80 max-w-3xl mx-auto leading-relaxed animate-fade-up font-light" style="animation-delay: 0.2s">
                @translate('No package fits your dream? Tell us your ideal destination, dates, and preferences — we’ll create a personalized travel experience just for you.')
            </p>
        </div>
    </section>

    <section class="container mx-auto px-6 py-20 -mt-20 relative z-20">
        {{-- Background Blobs --}}
        <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-[#00b4d8]/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-40 left-0 w-[500px] h-[500px] bg-[#003366]/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto glass-card rounded-[2.5rem] shadow-2xl shadow-blue-900/10 overflow-hidden animate-fade-up relative z-10" style="animation-delay: 0.4s">
            
            <div class="bg-gray-50/50 px-8 md:px-12 py-8 border-b border-gray-100 text-center">
                <h2 class="text-3xl font-bold text-primary font-serif">@translate('Your Travel Preferences')</h2>
                <p class="text-gray-500 mt-2 font-light">
                    @translate('Fill in the details below. We’ll get back within 24 hours with a curated quote.')
                </p>
            </div>

            <form action="{{ route('booking.custom.store') }}" method="POST" class="p-8 md:p-12 space-y-10">
                @csrf

                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-primary border-b border-gray-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-map-marked-alt text-secondary"></i> @translate('Trip Details')
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                            @translate('Destinations You Want to Visit') <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="custom_destinations" 
                            placeholder="<?php echo \App\Helpers\TranslationHelper::translate('e.g. Bali, Komodo, Lombok, Yogyakarta'); ?>"
                            class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors" required>
                        <p class="text-xs text-gray-400 mt-2 font-light">@translate('Separate multiple destinations with commas.')</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                @translate('Preferred Travel Date') <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="travel_date" required
                                class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors text-gray-600">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                @translate('Trip Duration') <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="duration_nights" 
                                placeholder="<?php echo \App\Helpers\TranslationHelper::translate('e.g. 3d 2n'); ?>"
                                pattern="(\d+\s*d)?\s*(\d+\s*n)?"
                                class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors"
                                required>
                            <p class="text-xs text-gray-400 mt-2 font-light">
                                @translate('Format:') <code class="text-primary font-bold">d</code> @translate('for days'), <code class="text-primary font-bold">n</code> @translate('for nights. Ex: 3d 2n')
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                @translate('Number of Travelers') <span class="text-red-500">*</span>
                            </label>

                            <select name="travelers_select" id="travelers_select" required 
                                    class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors cursor-pointer"
                                    onchange="toggleCustomTravelersInput()">
                                <option value="">@translate('Select number')</option>
                                <option value="1">@translate('1 person')</option>
                                <option value="2">@translate('2 people')</option>
                                <option value="3">@translate('3 people')</option>
                                <option value="4">@translate('4 people')</option>
                                <option value="5">@translate('5 people')</option>
                                <option value="6">@translate('6 people')</option>
                                <option value="other">@translate('Other (please specify)')</option>
                            </select>

                            <div id="custom_travelers_container" class="mt-4 hidden animate-fade-up">
                                <input type="number" 
                                    name="travelers_custom" 
                                    id="travelers_custom"
                                    min="1"
                                    placeholder="<?php echo \App\Helpers\TranslationHelper::translate('Enter specific number'); ?>"
                                    class="w-full p-4 border border-gray-200 rounded-xl bg-white border-secondary ring-1 ring-secondary"
                                    oninput="syncTravelersValue()">
                            </div>
                            <input type="hidden" name="travelers" id="travelers" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">@translate('Budget Range (per person)')</label>
                            <div class="relative">
                                <select name="budget_range" class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors appearance-none cursor-pointer">
                                    <option value="">@translate('No preference')</option>
                                    <option value="Below Rp 3 juta">@translate('Below Rp 3.000.000')</option>
                                    <option value="Rp 3 - 5 juta">@translate('Rp 3.000.000 - 5.000.000')</option>
                                    <option value="Rp 5 - 8 juta">@translate('Rp 5.000.000 - 8.000.000')</option>
                                    <option value="Rp 8 - 12 juta">@translate('Rp 8.000.000 - 12.000.000')</option>
                                    <option value="Above Rp 12 juta">@translate('Above Rp 12.000.000')</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-primary border-b border-gray-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-heart text-secondary"></i> @translate('Interests & Activities')
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">
                            @translate('What Interests You?')
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach(['Adventure', 'Relaxation', 'Cultural', 'Honeymoon', 'Family', 'Photography', 'Food & Culinary', 'Trekking', 'Beach'] as $interest)
                                <label class="cursor-pointer relative group">
                                    <input type="checkbox" name="interests[]" value="{{ $interest }}" class="peer sr-only">
                                    <div class="p-3 border border-gray-200 rounded-xl text-center text-sm text-gray-600 transition-all peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary group-hover:border-secondary">
                                        @translate($interest)
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-primary border-b border-gray-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-user text-secondary"></i> @translate('Contact Information')
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">@translate('First Name') <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">@translate('Last Name') <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">@translate('Email Address') <span class="text-red-500">*</span></label>
                            <input type="email" name="email" class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">@translate('Phone Number') <span class="text-red-500">*</span></label>
                            <div class="flex gap-3">
                                <select name="country_code" id="country_code" class="w-1/3 md:w-1/4 p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors text-sm" required>
                                    <option value="">@translate('Code')</option>
                                    <option value="+62">🇮🇩 +62</option>
                                    <option value="+1">🇺🇸 +1</option>
                                    <option value="+60">🇲🇾 +60</option>
                                    <option value="+65">🇸🇬 +65</option>
                                    <option value="+61">🇦🇺 +61</option>
                                    <option value="+44">🇬🇧 +44</option>
                                    <option value="+81">🇯🇵 +81</option>
                                    </select>
                                <input type="number" name="phone_number" placeholder="812345678" class="flex-1 p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors" required>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">@translate('Special Request / Notes')</label>
                            <textarea name="message" rows="4" 
                                placeholder="<?php echo \App\Helpers\TranslationHelper::translate('Tell us more about your dream trip...'); ?>" 
                                class="w-full p-4 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-colors resize-none"></textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="btn-premium w-full py-5 rounded-xl font-bold text-lg shadow-xl shadow-blue-900/20 hover:shadow-blue-900/40 flex items-center justify-center gap-3">
                        @translate('Submit Request') <i class="fas fa-paper-plane"></i>
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-4">
                        @translate('By submitting this form, you agree to our terms & conditions.')
                    </p>
                </div>
            </form>
        </div>
    </section>

    {{-- Floating WhatsApp (KEPT GREEN) --}}
    <a 
        href="https://api.whatsapp.com/send?phone=6281217006076&text=Halo%20Admin%20GOING%20TO%20THE%20JAVA%2C%20saya%20mau%20tanya%20tentang%20paket%20wisata.%20Boleh%20dibantu%3F"
   target="_blank"
   rel="noopener noreferrer"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group animate-bounce-slow"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium whitespace-nowrap">@translate('Need Help?')</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}" ></script>
        <script>
            function toggleCustomTravelersInput() {
                const select = document.getElementById('travelers_select');
                const container = document.getElementById('custom_travelers_container');
                const customInput = document.getElementById('travelers_custom');
                const hiddenInput = document.getElementById('travelers');

                if (select.value === 'other') {
                    container.classList.remove('hidden');
                    customInput.focus();
                    customInput.required = true;
                    select.required = false; 
                } else {
                    container.classList.add('hidden');
                    customInput.required = false;
                    select.required = true;
                    hiddenInput.value = select.value;
                }
            }

            function syncTravelersValue() {
                const customInput = document.getElementById('travelers_custom');
                const hiddenInput = document.getElementById('travelers');
                hiddenInput.value = customInput.value;
            }

            document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('travelers_select');
                const hiddenInput = document.getElementById('travelers');
                hiddenInput.value = select.value;

                select.addEventListener('change', function() {
                    if (this.value !== 'other') {
                        hiddenInput.value = this.value;
                    }
                });

                const customInput = document.getElementById('travelers_custom');
                if (customInput && customInput.value) {
                    hiddenInput.value = customInput.value;
                }
            });
        </script>
    @endpush
@endsection