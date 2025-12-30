@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- UNIFIED FONT TO POPPINS ONLY --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script> -->
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

        /* Utilities */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }
        .bg-surface { background-color: var(--color-surface) !important; }

        /* Animation */
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .animate-fade-up {
            opacity: 0; transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        /* Components */
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

        /* Form Styling */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--color-secondary);
            box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.1);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(0, 51, 102, 0.08);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- HERO SECTION --}}
    <section class="relative bg-primary h-80 flex items-center overflow-hidden" id="jumbotron">
        <div class="absolute inset-0 z-0">
            <img loading="lazy" src="{{ asset($car->image_car_1) }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1494905998402-395d579af36f?q=80&w=1920';"
                 alt="{{ $car->name_car }}"
                 class="w-full h-full object-cover object-center animate-float-slow"
                 style="opacity: 0.5;">
            {{-- Blue Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/90 via-[#003366]/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-10 text-center animate-fade-up">
            <span class="bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block shadow-lg shadow-secondary/30">
                {{ ucfirst($car->car_type ?? 'General') }} Car
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-serif text-shadow-lg drop-shadow-md">{{ $car->name_car }}</h1>
            <p class="text-lg text-white/90 font-light flex items-center justify-center gap-2">
                <span>{{ $car->capacity }} Seats</span>
                <span class="text-secondary">•</span>
                <span>{{ ucfirst($car->transmission) }}</span>
            </p>
        </div>
    </section>

    {{-- BREADCRUMBS --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 py-4 sticky top-16 z-30 shadow-sm">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-500 font-medium">
                <li><a href="{{ route('index') }}" class="hover:text-primary transition-colors">Home</a></li>
                <li>/</li>
                <li><a href="{{ route('usercar.index') }}" class="hover:text-primary transition-colors">Cars</a></li>
                <li>/</li>
                <li class="text-primary font-bold">{{ $car->name_car }}</li>
            </ol>
        </div>
    </nav>

    {{-- BOOKING FORM --}}
    <section class="container mx-auto px-6 py-16 relative">
        {{-- Background Blobs --}}
        <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-[#00b4d8]/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-40 left-0 w-[500px] h-[500px] bg-[#003366]/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-3xl mx-auto glass-card rounded-[2rem] shadow-2xl overflow-hidden animate-fade-up relative z-10">
            <div class="bg-gray-50/50 px-8 py-8 border-b border-gray-100 text-center">
                <h2 class="text-2xl font-bold text-primary font-serif">Confirm Your Rental</h2>
                <p class="text-gray-500 mt-2 font-light">Please review your booking details below.</p>
            </div>

            <form action="{{ route('bookingStore') }}" method="POST" class="p-8 md:p-12 space-y-8">
                @csrf

                <input type="hidden" name="car_id" value="{{ $car->car_id }}">

                {{-- Car Summary Card --}}
                <div class="bg-primary/5 p-6 rounded-2xl border border-primary/10 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-14 rounded-lg overflow-hidden shadow-sm flex-shrink-0">
                            <img src="{{ asset($car->image_car_1) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-bold text-primary text-lg font-serif">{{ $car->name_car }}</h3>
                            <p class="text-gray-500 text-xs mt-1">{{ ucfirst($car->transmission) }} • {{ $car->capacity }} Seats</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-bold mb-1">Rate / Day</p>
                        <p class="text-xl font-bold text-secondary">Rp{{ number_format($car->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="customer_name" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all"
                            placeholder="Enter your full name" value="{{ old('customer_name') }}">
                        @error('customer_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="customer_email" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all"
                            placeholder="john@example.com" value="{{ old('customer_email') }}">
                        @error('customer_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Phone Number</label>
                        <div class="flex gap-2">
                            <select name="country_code" class="w-1/3 px-3 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white text-sm transition-all" required>
                                <option value="+62">🇮🇩 +62</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+60">🇲🇾 +60</option>
                                <option value="+65">🇸🇬 +65</option>
                                <option value="+61">🇦🇺 +61</option>
                                </select>
                            <input type="tel" name="customer_phone" placeholder="81234567890"
                                class="flex-1 px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all"
                                required value="{{ old('customer_phone') }}">
                        </div>
                        @error('customer_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Start Date</label>
                        <input type="date" name="start_date" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all"
                            min="{{ now()->format('Y-m-d') }}">
                        @error('start_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">End Date</label>
                        <input type="date" name="end_date" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all"
                            min="{{ now()->addDay()->format('Y-m-d') }}">
                        @error('end_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-3">Rental Type</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="rental_type" value="0" class="peer sr-only" {{ old('rental_type', $car->rental_type == false) ? 'checked' : '' }}>
                            <div class="p-4 border border-gray-200 rounded-xl text-center peer-checked:border-secondary peer-checked:bg-secondary/10 peer-checked:text-primary hover:bg-gray-50 transition-all">
                                <i class="fas fa-user mb-2 text-xl block"></i>
                                <span class="font-bold text-sm">Self Drive</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="rental_type" value="1" class="peer sr-only" {{ old('rental_type', $car->rental_type == true) ? 'checked' : '' }}>
                            <div class="p-4 border border-gray-200 rounded-xl text-center peer-checked:border-secondary peer-checked:bg-secondary/10 peer-checked:text-primary hover:bg-gray-50 transition-all">
                                <i class="fas fa-user-tie mb-2 text-xl block"></i>
                                <span class="font-bold text-sm">With Driver</span>
                            </div>
                        </label>
                    </div>
                    @error('rental_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Special Request</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all resize-none"
                        placeholder="e.g., Child seat needed, specific pickup location...">{{ old('notes') }}</textarea>
                </div>

                {{-- Total Price Bar --}}
                <div class="bg-primary text-white p-6 rounded-2xl flex flex-col sm:flex-row justify-between items-center gap-4 shadow-lg">
                    <div class="text-center sm:text-left">
                        <p class="text-sm text-gray-300 mb-1">Estimated Total</p>
                        <div class="text-3xl font-bold font-serif text-secondary" id="total-price">Rp0</div>
                        <p class="text-xs text-gray-400 mt-1" id="duration-text">Duration: 0 Days</p>
                    </div>
                    <button type="submit" class="btn-premium px-8 py-4 rounded-xl font-bold shadow-lg w-full sm:w-auto hover:bg-white hover:text-primary transition-colors">
                        Confirm Booking <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- Floating WhatsApp (KEPT GREEN) --}}
    <a href="https://api.whatsapp.com/send?phone=6281217006076&text=Halo%20Admin%20GOING%20TO%20THE%20JAVA%2C%20saya%20mau%20tanya%20tentang%20paket%20wisata.%20Boleh%20dibantu%3F"
   target="_blank"
   rel="noopener noreferrer" class="fixed bottom-8 right-8 z-50 flex items-center gap-3 bg-[#25D366] text-white px-5 py-3 rounded-full shadow-2xl hover:bg-[#20bd5a] hover:scale-105 transition-all duration-300 animate-bounce group">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-bold whitespace-nowrap hidden group-hover:block transition-all">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const startDateInput = document.querySelector('input[name="start_date"]');
                const endDateInput = document.querySelector('input[name="end_date"]');
                const durationElement = document.getElementById('duration-text');
                const totalElement = document.getElementById('total-price');
                const carPrice = {{ $car->price }};

                function calculatePrice() {
                    if (!startDateInput.value || !endDateInput.value) {
                        durationElement.textContent = 'Duration: 0 Days';
                        totalElement.textContent = 'Rp0';
                        return;
                    }

                    const startDate = new Date(startDateInput.value);
                    const endDate = new Date(endDateInput.value);
                    
                    if (endDate <= startDate) {
                        durationElement.textContent = 'Invalid Duration';
                        totalElement.textContent = 'Rp0';
                        return;
                    }

                    const diffTime = Math.abs(endDate - startDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    durationElement.textContent = 'Duration: ' + diffDays + ' Days';
                    totalElement.textContent = 'Rp' + (diffDays * carPrice).toLocaleString('id-ID');
                }

                startDateInput.addEventListener('change', calculatePrice);
                endDateInput.addEventListener('change', calculatePrice);
            });
        </script>
    @endpush
@endsection