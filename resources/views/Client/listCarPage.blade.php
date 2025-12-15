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
        .bg-surface { background-color: var(--color-surface) !important; }

        /* Animation */
        .animate-fade-up {
            opacity: 0; transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        /* Components */
        .car-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .car-image { transition: transform 0.7s ease; }
        .car-card:hover .car-image { transform: scale(1.08); }

        .status-badge {
            position: absolute;
            top: 1rem; right: 1rem;
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        /* Filter Sidebar */
        .filter-sidebar {
            position: sticky; top: 100px;
            border-radius: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .filter-item {
            transition: all 0.2s ease;
            border-radius: 0.75rem;
        }
        .filter-item:hover {
            background-color: rgba(10, 61, 38, 0.05);
            color: var(--color-primary);
        }
        .filter-item.active {
            background-color: var(--color-primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(10, 61, 38, 0.2);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <section id="jumbotron" class="relative bg-primary min-h-[40vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/bg_header_listcar.jpg') }}" 
                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1494905998402-395d579af36f?q=80&w=1920';"
                 alt="Car Fleet Header" 
                 class="w-full h-full object-cover object-center opacity-40 animate-pulse">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 pt-20 text-center">
            <div class="max-w-3xl mx-auto animate-fade-up">
                <span class="text-secondary font-bold tracking-[0.3em] uppercase text-xs mb-4 block">Premium Fleet</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 font-serif">Choose Your <span class="italic text-secondary">Ride</span></h1>
                <p class="text-lg text-white/80 leading-relaxed font-light mb-8">
                    Choose your perfect ride for every adventure — from city commutes to mountain escapes.
                </p>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto">
                    @foreach([
                        [$cars->count(), 'Total Cars'],
                        ['4.8', 'Avg Rating'],
                        [$cars->where('car_status', 'available')->count(), 'Available'],
                        ['24/7', 'Support']
                    ] as $stat)
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/10">
                        <div class="text-xl font-bold text-white mb-1">{{ $stat[0] }}</div>
                        <div class="text-xs text-white/60 uppercase tracking-wider">{{ $stat[1] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex flex-col lg:flex-row gap-10">
            
            <div class="lg:w-80 flex-shrink-0">
                <div class="bg-white shadow-xl p-6 filter-sidebar">
                    <div class="flex items-center gap-3 mb-8 pb-4 border-b border-gray-100">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-serif">Filter & Sort</h3>
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Sort By</label>
                        <div class="relative">
                            <select onchange="window.location.href = this.value"
                                class="w-full p-3 pl-4 pr-10 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-primary/20 outline-none appearance-none cursor-pointer text-sm font-medium text-gray-700">
                                <option value="{{ route('usercar.index') }}?sort=newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>Newest First</option>
                                <option value="{{ route('usercar.index') }}?sort=oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="{{ route('usercar.index') }}?sort=price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="{{ route('usercar.index') }}?sort=price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div>
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-sm">
                                <i class="fas fa-car-side text-secondary"></i> Car Type
                            </h4>
                            <div class="space-y-2">
                                <a href="{{ route('usercar.index') }}" 
                                    class="block px-4 py-2.5 text-sm font-medium filter-item {{ !request('type') ? 'active' : 'text-gray-600' }}">
                                    All Types
                                </a>
                                @foreach($carTypes as $type)
                                    <a href="{{ route('usercar.index') }}?type={{ urlencode($type) }}" 
                                        class="block px-4 py-2.5 text-sm font-medium filter-item {{ request('type') == $type ? 'active' : 'text-gray-600' }}">
                                        {{ $type }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-sm">
                                <i class="fas fa-cogs text-secondary"></i> Transmission
                            </h4>
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ request()->fullUrlWithQuery(['transmission' => 'manual']) }}" 
                                    class="text-center px-2 py-2.5 text-xs font-bold rounded-lg border {{ request('transmission') == 'manual' ? 'bg-primary text-white border-primary' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                                    Manual
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['transmission' => 'automatic']) }}" 
                                    class="text-center px-2 py-2.5 text-xs font-bold rounded-lg border {{ request('transmission') == 'automatic' ? 'bg-primary text-white border-primary' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                                    Automatic
                                </a>
                            </div>
                        </div>

                        @if(request()->query())
                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ route('usercar.index') }}" 
                                    class="block w-full text-center px-4 py-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors font-bold text-sm">
                                    <i class="fas fa-times mr-2"></i> Reset Filters
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <div class="mb-8 flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-bold text-primary">
                        {{ $cars->total() }} Vehicles Available
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($cars as $index => $car)
                        <div class="car-card bg-white overflow-hidden shadow-lg animate-fade-up" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="relative h-52 overflow-hidden bg-gray-100">
                                <img loading="lazy" 
                                    src="{{ asset($car->image_car_1) }}" 
                                    alt="{{ $car->name_car }}"
                                    onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=800';"
                                    class="w-full h-full object-cover car-image">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>

                                <span class="status-badge {{ $car->car_status == 'available' ? 'bg-green-500/90 text-white' : 'bg-red-500/90 text-white' }}">
                                    {{ ucfirst($car->car_status) }}
                                </span>
                            </div>

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <span class="text-[10px] font-bold text-secondary uppercase tracking-wider block mb-1">
                                            {{ $car->car_type ?? 'Sedan' }}
                                        </span>
                                        <h3 class="text-xl font-bold text-primary font-serif line-clamp-1">{{ $car->name_car }}</h3>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 text-xs text-gray-500 mb-6 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <span class="flex items-center gap-1.5"><i class="fas fa-users text-secondary"></i> {{ $car->capacity }} Seats</span>
                                    <span class="w-px h-3 bg-gray-300"></span>
                                    <span class="flex items-center gap-1.5"><i class="fas fa-cog text-secondary"></i> {{ ucfirst($car->transmission) }}</span>
                                    <span class="w-px h-3 bg-gray-300"></span>
                                    <span class="flex items-center gap-1.5"><i class="fas fa-gas-pump text-secondary"></i> Petrol</span>
                                </div>

                                <div class="flex items-end justify-between border-t border-gray-100 pt-4">
                                    <div>
                                        <span class="text-xs text-gray-400 block mb-0.5">Daily Rate</span>
                                        <span class="text-xl font-bold text-primary">Rp{{ number_format($car->price, 0, ',', '.') }}</span>
                                    </div>
                                    <a href="{{ route('car.detail', $car->slug) }}"
                                        class="px-5 py-2.5 bg-primary text-white rounded-lg font-bold text-sm hover:bg-[#145a3a] transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                                        Book <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="bg-white text-center rounded-[2rem] p-12 border border-gray-100 shadow-sm">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                                    <i class="fas fa-car-crash text-4xl"></i>
                                </div>
                                <h3 class="text-2xl font-serif font-bold text-gray-800 mb-2">No cars found</h3>
                                <p class="text-gray-500 mb-8 max-w-md mx-auto">We couldn't find any vehicles matching your current filters. Try adjusting your search criteria.</p>
                                <a href="{{ route('usercar.index') }}"
                                    class="inline-block px-8 py-3 bg-primary text-white rounded-full font-bold hover:bg-[#145a3a] transition-all shadow-lg">
                                    Clear Filters
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($cars->hasPages())
                    <div class="mt-12">
                        {{ $cars->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <a href="https://wa.me/6281217006076" target="_blank" class="fixed bottom-8 right-8 z-50 flex items-center gap-3 bg-[#25D366] text-white px-5 py-3 rounded-full shadow-2xl hover:bg-[#20bd5a] hover:scale-105 transition-all duration-300 animate-bounce group">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-bold whitespace-nowrap hidden group-hover:block transition-all">Chat Support</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
    @endpush
@endsection