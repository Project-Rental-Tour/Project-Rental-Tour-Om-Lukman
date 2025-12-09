@extends('_layouts.user')

@section('head')
    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* --- Premium Green Theme Configuration --- */
        :root {
            --color-primary: #0a3d26;   /* Deep Forest Green */
            --color-primary-light: #145a3a;
            --color-secondary: #cfa372; /* Luxury Gold */
            --color-secondary-light: #e0c09a;
            --color-surface: #fdfbf8;   /* Off-White/Paper */
            --color-text: #3d3d3d;
            --color-text-light: #7a7a7a;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-surface);
            color: var(--color-text);
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.01em;
        }

        /* Utilities */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }

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
        .btn-premium:hover { box-shadow: 0 10px 25px -5px rgba(10, 61, 38, 0.4); transform: translateY(-2px); }

        /* Form Styling */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(10, 61, 38, 0.1);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section class="relative bg-primary h-80 flex items-center overflow-hidden" id="jumbotron">
        <div class="absolute inset-0 z-0">
            <img loading="lazy" src="{{ asset($car->image_car_1) }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1494905998402-395d579af36f?q=80&w=1920';"
                 alt="{{ $car->name_car }}"
                 class="w-full h-full object-cover object-center opacity-40 animate-float-slow">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-10 text-center animate-fade-up">
            <span class="bg-secondary text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">
                {{ ucfirst($car->car_type ?? 'General') }} Car
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-serif text-shadow-lg">{{ $car->name_car }}</h1>
            <p class="text-lg text-white/90 font-light flex items-center justify-center gap-2">
                <span>{{ $car->capacity }} Seats</span>
                <span class="text-secondary">•</span>
                <span>{{ ucfirst($car->transmission) }}</span>
            </p>
        </div>
    </section>

    <nav class="bg-white border-b border-gray-100 py-4 sticky top-16 z-30 shadow-sm">
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

    <section class="container mx-auto px-6 py-16">
        <div class="max-w-3xl mx-auto bg-white rounded-[2rem] shadow-2xl border border-gray-100 overflow-hidden animate-fade-up">
            <div class="bg-gray-50/80 px-8 py-8 border-b border-gray-100 text-center">
                <h2 class="text-2xl font-bold text-primary font-serif">Confirm Your Rental</h2>
                <p class="text-gray-500 mt-2 font-light">Please review your booking details below.</p>
            </div>

            <form action="{{ route('bookingStore') }}" method="POST" class="p-8 md:p-12 space-y-8">
                @csrf

                <input type="hidden" name="car_id" value="{{ $car->car_id }}">

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
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white transition-colors"
                            placeholder="Enter your full name" value="{{ old('customer_name') }}">
                        @error('customer_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="customer_email" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white transition-colors"
                            placeholder="john@example.com" value="{{ old('customer_email') }}">
                        @error('customer_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Phone Number</label>
                        <div class="flex gap-2">
                            <select name="country_code" class="w-1/3 px-3 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white text-sm" required>
                                <option value="+62">🇮🇩 +62</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+60">🇲🇾 +60</option>
                                <option value="+65">🇸🇬 +65</option>
                                <option value="+61">🇦🇺 +61</option>
                                </select>
                            <input type="tel" name="customer_phone" placeholder="81234567890"
                                class="flex-1 px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white transition-colors"
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
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white transition-colors"
                            min="{{ now()->format('Y-m-d') }}">
                        @error('start_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">End Date</label>
                        <input type="date" name="end_date" required 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white transition-colors"
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
                            <div class="p-4 border border-gray-200 rounded-xl text-center peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary hover:bg-gray-50 transition-all">
                                <i class="fas fa-user mb-2 text-xl block"></i>
                                <span class="font-bold text-sm">Self Drive</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="rental_type" value="1" class="peer sr-only" {{ old('rental_type', $car->rental_type == true) ? 'checked' : '' }}>
                            <div class="p-4 border border-gray-200 rounded-xl text-center peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary hover:bg-gray-50 transition-all">
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
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white transition-colors resize-none"
                        placeholder="e.g., Child seat needed, specific pickup location...">{{ old('notes') }}</textarea>
                </div>

                <div class="bg-gray-900 text-white p-6 rounded-2xl flex flex-col sm:flex-row justify-between items-center gap-4 shadow-lg">
                    <div class="text-center sm:text-left">
                        <p class="text-sm text-gray-400 mb-1">Estimated Total</p>
                        <div class="text-3xl font-bold font-serif text-secondary" id="total-price">Rp0</div>
                        <p class="text-xs text-gray-500 mt-1" id="duration-text">Duration: 0 Days</p>
                    </div>
                    <button type="submit" class="btn-premium px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-green-500/20 w-full sm:w-auto">
                        Confirm Booking <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <a href="https://wa.me/6281220005276" target="_blank" class="fixed bottom-8 right-8 z-50 flex items-center gap-3 bg-[#25D366] text-white px-5 py-3 rounded-full shadow-2xl hover:bg-[#20bd5a] hover:scale-105 transition-all duration-300 animate-bounce group">
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