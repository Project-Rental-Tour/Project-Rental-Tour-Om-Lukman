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

        /* --- Typography --- */
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.01em;
        }
        
        .text-balance { text-wrap: balance; }

        /* --- Custom Utilities --- */
        .bg-primary { background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .text-secondary { color: var(--color-secondary) !important; }
        .bg-surface { background-color: var(--color-surface) !important; }

        /* --- Components --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
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
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        .btn-premium:hover::after { left: 100%; }
        .btn-premium:hover { box-shadow: 0 10px 25px -5px rgba(10, 61, 38, 0.4); transform: translateY(-2px); }

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
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(10, 61, 38, 0.1);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section class="relative bg-primary text-white h-80 overflow-hidden" id="jumbotron">
        <div class="absolute inset-0 z-0">
            <img loading="lazy" src="{{ asset($destination->destination_photo) }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&q=80';"
                 alt="{{ $destination->name_package }}"
                 class="w-full h-full object-cover object-center opacity-40 animate-float-slow">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
        </div>

        <div class="absolute inset-0 flex items-center justify-center pt-10">
            <div class="container mx-auto px-6 text-center animate-fade-up">
                <span class="bg-secondary text-primary text-xs px-3 py-1 rounded-full mb-4 inline-block font-bold uppercase tracking-wider">
                    {{ ucfirst($destination->category) }} Trip
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 font-serif text-shadow-lg">{{ $destination->name_package }}</h1>
                <p class="text-lg text-white/90 font-light flex items-center justify-center gap-2">
                    <i class="fas fa-map-marker-alt text-secondary"></i> {{ $destination->place }} 
                    <span class="mx-2">•</span> 
                    <i class="fas fa-clock text-secondary"></i> {{ $destination->time }}
                </p>
            </div>
        </div>
    </section>

    <nav class="bg-white py-4 border-b border-gray-100 shadow-sm sticky top-16 z-30">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-500 font-medium">
                <li><a href="{{route('index')}}" class="hover:text-primary transition-colors">Home</a></li>
                <li>/</li>
                <li><a href="{{route('destination.index')}}" class="hover:text-primary transition-colors">Destinations</a></li>
                <li>/</li>
                <li class="text-primary font-bold">{{ $destination->name_package }}</li>
            </ol>
        </div>
    </nav>

    <section class="container mx-auto px-6 py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-[2rem] shadow-2xl border border-gray-100 overflow-hidden animate-fade-up">
            
            <div class="bg-gray-50/80 px-8 py-8 border-b border-gray-100 text-center">
                <h2 class="text-3xl font-bold text-primary font-serif">Complete Your Booking</h2>
                <p class="text-gray-500 mt-2 font-light">Please fill in your details to secure your spot.</p>
            </div>

            <form action="{{ route('booking.regular.store') }}" method="POST" class="p-8 md:p-12 space-y-8">
                @csrf

                <input type="hidden" name="destination_id" value="{{ $destination->destination_id }}">

                <div class="bg-primary/5 p-6 rounded-2xl border border-primary/10 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-xl overflow-hidden shadow-md">
                            <img src="{{ asset($destination->destination_photo) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-bold text-primary text-lg font-serif">{{ $destination->name_package }}</h3>
                            <p class="text-gray-500 text-sm">{{ $destination->place }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-bold mb-1">Price per person</p>
                        <p class="text-2xl font-bold text-secondary">
                            Rp{{ number_format($destination->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">First Name</label>
                        <input type="text" name="first_name" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:bg-white bg-gray-50 transition-colors"
                            placeholder="John" autocomplete="given-name">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Last Name</label>
                        <input type="text" name="last_name" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:bg-white bg-gray-50 transition-colors"
                            placeholder="Doe" autocomplete="family-name">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:bg-white bg-gray-50 transition-colors"
                        placeholder="john.doe@example.com" autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>

                    <div class="flex gap-3">
                        <div class="relative w-1/3 md:w-1/4">
                            <select name="country_code" id="country_code"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:bg-white bg-gray-50 transition-colors appearance-none cursor-pointer"
                                required>
                                <option value="" disabled selected>Code</option>
                                <option value="+62">🇮🇩 +62</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+60">🇲🇾 +60</option>
                                <option value="+65">🇸🇬 +65</option>
                                <option value="+61">🇦🇺 +61</option>
                                <option value="+44">🇬🇧 +44</option>
                                <option value="+81">🇯🇵 +81</option>
                                </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                        <input type="tel" name="phone_number" placeholder="81234567890"
                            class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:bg-white bg-gray-50 transition-colors"
                            required>
                    </div>
                    <p class="mt-2 text-xs text-gray-400 font-light">We will contact you via WhatsApp for confirmation.</p>
                </div>

                <div class="pt-6 border-t border-gray-100">
                    <button type="submit" class="btn-premium w-full py-4 rounded-xl font-bold text-lg shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                        Confirm Booking <i class="fas fa-check-circle"></i>
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-4">By booking, you agree to our Terms & Conditions.</p>
                </div>

            </form>
        </div>
    </section>

    <a href="https://wa.me/6281217006076?text=Hi%20GOING%20TO%20THE%20JAVA!%20I%20have%20a%20question..." 
       target="_blank"
       id="whatsapp-float"
       class="fixed bottom-8 right-8 z-50 flex items-center gap-3 bg-[#25D366] text-white px-5 py-3 rounded-full shadow-2xl hover:bg-[#20bd5a] hover:scale-105 transition-all duration-300 animate-bounce group">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-bold whitespace-nowrap hidden group-hover:block transition-all">Need Help?</span>
    </a>

    @include('components.client.footer')
    <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
@endsection