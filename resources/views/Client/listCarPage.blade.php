@extends('_layouts.user')

@section('head')
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* --- Premium Blue Ocean Theme Configuration (Sama dengan Home) --- */
        :root {
            --color-primary: #003366;   /* Deep Ocean Navy */
            --color-primary-light: #004080;
            --color-secondary: #00b4d8; /* Pacific Cyan/Sky Blue */
            --color-secondary-light: #90e0ef;
            --color-surface: #f4f8fb;   /* Very Light Blue/White */
            --color-text: #1e293b;
            --color-text-light: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-surface);
            color: var(--color-text);
        }

        /* --- Noise Texture --- */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: multiply;
        }

        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* --- Components --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(0, 51, 102, 0.08);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: var(--color-secondary);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px -10px rgba(0, 51, 102, 0.15);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-premium:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 51, 102, 0.4);
            transform: translateY(-2px);
        }

        .btn-outline-premium {
            border: 1px solid var(--color-primary);
            color: var(--color-primary);
            background: transparent;
            transition: all 0.3s ease;
        }
        .btn-outline-premium:hover {
            background: var(--color-primary);
            color: white;
        }

        /* Form Elements Customization */
        .form-checkbox:checked {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }
        
        .filter-group {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .filter-group:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    {{-- 1. HERO HEADER --}}
    <header class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-[#003366]/10 to-transparent pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#00b4d8]/10 rounded-full mix-blend-multiply filter blur-[100px] opacity-60"></div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-[#00b4d8] font-bold tracking-[0.3em] uppercase text-xs mb-4 block animate-fade-up">Our Fleet</span>
            <h1 class="text-4xl md:text-6xl font-bold text-[#003366] mb-6 font-serif animate-fade-up">
                Choose Your <span class="italic text-[#00b4d8]">Journey</span>
            </h1>
            <p class="text-[#64748b] max-w-2xl mx-auto text-lg font-light leading-relaxed animate-fade-up">
                From compact city cruisers to spacious family vans, find the perfect vehicle for your Javanese adventure.
            </p>
        </div>
    </header>

    {{-- 2. MAIN CONTENT (Sidebar + Grid) --}}
    <section class="pb-24 px-6">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row gap-10">
                
                {{-- SIDEBAR FILTER --}}
                <aside class="w-full lg:w-1/4 animate-fade-up">
                    <div class="glass-card p-6 rounded-3xl sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-serif text-xl font-bold text-[#003366]">Filters</h3>
                            <a href="{{ url()->current() }}" class="text-xs text-[#00b4d8] font-bold hover:underline">Reset All</a>
                        </div>

                        <form action="{{ url()->current() }}" method="GET">
                            
                            {{-- Filter: Type --}}
                            <div class="filter-group">
                                <label class="block text-sm font-bold text-[#003366] mb-3 uppercase tracking-wider">Car Type</label>
                                <div class="space-y-2">
                                    @foreach($carTypes as $type)
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="radio" name="type" value="{{ $type }}" 
                                            {{ request('type') == $type ? 'checked' : '' }}
                                            class="form-radio text-[#003366] focus:ring-[#00b4d8] h-4 w-4 border-gray-300">
                                        <span class="text-gray-600 group-hover:text-[#003366] transition-colors text-sm">{{ ucfirst($type) }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Filter: Transmission --}}
                            <div class="filter-group">
                                <label class="block text-sm font-bold text-[#003366] mb-3 uppercase tracking-wider">Transmission</label>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="radio" name="transmission" value="Automatic" 
                                            {{ request('transmission') == 'Automatic' ? 'checked' : '' }}
                                            class="form-radio text-[#003366] focus:ring-[#00b4d8] h-4 w-4 border-gray-300">
                                        <span class="text-gray-600 group-hover:text-[#003366] transition-colors text-sm">Automatic</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="radio" name="transmission" value="Manual" 
                                            {{ request('transmission') == 'Manual' ? 'checked' : '' }}
                                            class="form-radio text-[#003366] focus:ring-[#00b4d8] h-4 w-4 border-gray-300">
                                        <span class="text-gray-600 group-hover:text-[#003366] transition-colors text-sm">Manual</span>
                                    </label>
                                </div>
                            </div>

                            {{-- Filter: Capacity --}}
                            <div class="filter-group">
                                <label class="block text-sm font-bold text-[#003366] mb-3 uppercase tracking-wider">Capacity</label>
                                <select name="capacity" class="w-full bg-white/50 border border-gray-200 rounded-xl px-4 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#00b4d8] focus:ring-1 focus:ring-[#00b4d8]">
                                    <option value="">Any Capacity</option>
                                    <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4 Seats</option>
                                    <option value="6" {{ request('capacity') == '6' ? 'selected' : '' }}>6 Seats</option>
                                    <option value="8" {{ request('capacity') == '8' ? 'selected' : '' }}>8+ Seats (Large Group)</option>
                                </select>
                            </div>

                            {{-- Filter: Price --}}
                            <div class="filter-group">
                                <label class="block text-sm font-bold text-[#003366] mb-3 uppercase tracking-wider">Price Range</label>
                                <select name="price_range" class="w-full bg-white/50 border border-gray-200 rounded-xl px-4 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#00b4d8] focus:ring-1 focus:ring-[#00b4d8]">
                                    <option value="">All Prices</option>
                                    <option value="low" {{ request('price_range') == 'low' ? 'selected' : '' }}>Budget (< IDR 500k)</option>
                                    <option value="medium" {{ request('price_range') == 'medium' ? 'selected' : '' }}>Standard (500k - 1M)</option>
                                    <option value="high" {{ request('price_range') == 'high' ? 'selected' : '' }}>Luxury (> IDR 1M)</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full btn-premium py-3 rounded-xl font-bold mt-4 shadow-lg text-sm uppercase tracking-wide">
                                Apply Filters
                            </button>
                        </form>
                    </div>
                </aside>

                {{-- CAR GRID --}}
                <div class="w-full lg:w-3/4">
                    @if($cars->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($cars as $car)
                            <div class="glass-card rounded-[2rem] overflow-hidden flex flex-col h-full group animate-fade-up">
                                {{-- Image Container --}}
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ asset($car->image_car_1) }}" 
                                         onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=600';"
                                         alt="{{ $car->name_car }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    
                                    {{-- Badges --}}
                                    <div class="absolute top-4 left-4 flex gap-2">
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-bold text-[#003366] shadow-sm uppercase tracking-wide">
                                            {{ $car->car_type }}
                                        </span>
                                    </div>

                                    @if($car->rental_type)
                                    <div class="absolute bottom-4 right-4">
                                        <span class="px-3 py-1 bg-[#00b4d8] text-white rounded-full text-[10px] font-bold shadow-md">
                                            With Driver
                                        </span>
                                    </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="font-serif text-xl font-bold text-[#003366] mb-4 group-hover:text-[#00b4d8] transition-colors">
                                        {{ $car->name_car }}
                                    </h3>

                                    {{-- Specs Grid --}}
                                    <div class="grid grid-cols-2 gap-y-3 gap-x-2 text-sm text-[#64748b] mb-6">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-users text-[#00b4d8] w-4"></i>
                                            <span>{{ $car->capacity }} Seats</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-cogs text-[#00b4d8] w-4"></i>
                                            <span>{{ $car->transmission }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 col-span-2">
                                            <i class="fas fa-gas-pump text-[#00b4d8] w-4"></i>
                                            <span>Include Fuel: {{ $car->include_fuel ? 'Yes' : 'No' }}</span>
                                        </div>
                                    </div>

                                    <div class="mt-auto border-t border-gray-100 pt-4 flex items-end justify-between">
                                        <div>
                                            <p class="text-xs text-gray-400 mb-0.5">Starting from</p>
                                            <p class="text-lg font-bold text-[#003366]">
                                                IDR {{ number_format($car->price, 0, ',', '.') }}
                                                <span class="text-xs font-normal text-gray-400">/day</span>
                                            </p>
                                        </div>
                                        {{-- Note: Pastikan route detailCar ada di web.php Anda --}}
                                        <a href="{{ route('car.detail', $car->slug) }}" class="w-10 h-10 rounded-full bg-[#003366] text-white flex items-center justify-center hover:bg-[#00b4d8] transition-colors shadow-lg">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-12">
                            {{ $cars->links() }}
                        </div>
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-20 glass-card rounded-[3rem]">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                                <i class="fas fa-car-crash text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-serif font-bold text-[#003366] mb-2">No Cars Found</h3>
                            <p class="text-gray-500 mb-6">We couldn't find any vehicles matching your filters.</p>
                            <a href="{{ url()->current() }}" class="btn-premium px-8 py-3 rounded-full text-white font-bold inline-block">
                                Clear Filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('components.client.footer')

@endsection