@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .bg-primary { background-color: #799eff; }
        .text-primary { color: #799eff; }
        .bg-primary-opacity { background-color: rgba(121, 158, 255, 0.05); }
        .text-white { color: #ffffff; }
        .text-green { color: #10b981; }

        .animate-fade-up {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeUp 0.6s ease-out forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up:nth-child(1) { animation-delay: 0.1s; }
        .animate-fade-up:nth-child(2) { animation-delay: 0.2s; }
        .animate-fade-up:nth-child(3) { animation-delay: 0.3s; }
        .animate-fade-up:nth-child(4) { animation-delay: 0.4s; }

        /* Hero Section */
        .hero-gradient {
            background: linear-gradient(135deg, rgba(121, 158, 255, 0.9) 0%, rgba(79, 70, 229, 0.9) 100%);
        }

        /* Card Hover Effect */
        .car-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Image Hover Zoom */
        .car-image {
            transition: transform 0.5s ease-in-out;
        }
        .car-card:hover .car-image {
            transform: scale(1.05);
        }

        /* Status Badge */
        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Filter Sidebar */
        .filter-sidebar {
            transition: all 0.3s ease;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .filter-sidebar:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Filter Accordion */
        .filter-section {
            transition: all 0.3s ease;
        }
        .filter-section.active {
            background-color: rgba(121, 158, 255, 0.05);
        }

        /* Filter Item */
        .filter-item {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
        }
        .filter-item:hover {
            background-color: rgba(121, 158, 255, 0.1);
            transform: translateX(4px);
        }
        .filter-item.active {
            background-color: rgba(121, 158, 255, 0.2);
            color: #799eff;
            font-weight: 600;
        }

        /* Quick Stats */
        .stat-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Empty State */
        .empty-state {
            transition: all 0.3s ease;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* WhatsApp Button */
        .whatsapp-float {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .whatsapp-float:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .animate-bounce-slow {
            animation: bounce 2s ease-in-out infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Sorting Dropdown */
        .sort-dropdown {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
        }
        .sort-dropdown:focus-within {
            box-shadow: 0 0 0 3px rgba(121, 158, 255, 0.3);
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <!-- Hero Section -->
    <section id="jumbotron" class="relative bg-gray-900 text-white h-96 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/50 to-purple-900/50"></div>
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <img loading="lazy" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1920&q=80" 
            alt="Car Fleet" class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl animate-fade-up">
                    <br>
                    <br>
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Our Premium Car Fleet</h1>
                    <p class="text-xl text-blue-200 mb-8">Choose your perfect ride for every adventure — from city commutes to mountain escapes.</p>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <div class="text-2xl font-bold">{{ $cars->count() }}</div>
                            <div class="text-sm">Total Cars</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <div class="text-2xl font-bold">4.8</div>
                            <div class="text-sm">Avg Rating</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <div class="text-2xl font-bold">{{ $cars->where('car_status', 'available')->count() }}</div>
                            <div class="text-sm">Available</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <div class="text-2xl font-bold">24/7</div>
                            <div class="text-sm">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter and Content Section -->
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filter Sidebar -->
            <div class="lg:w-80">
                <div class="bg-white rounded-2xl shadow-xl p-6 filter-sidebar sticky top-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                        </svg>
                        Filter & Sort
                    </h3>

                    <!-- Sorting -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Sort By</label>
                        <select onchange="window.location.href = this.value"
                            class="w-full p-3 border border-gray-300 rounded-xl sort-dropdown focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="{{ route('usercar.index') }}?sort=newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>
                                Newest First
                            </option>
                            <option value="{{ route('usercar.index') }}?sort=oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                Oldest First
                            </option>
                            <option value="{{ route('usercar.index') }}?sort=price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>
                                Price: Low to High
                            </option>
                            <option value="{{ route('usercar.index') }}?sort=price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>
                                Price: High to Low
                            </option>
                            <option value="{{ route('usercar.index') }}?sort=name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>
                                Name: A-Z
                            </option>
                            <option value="{{ route('usercar.index') }}?sort=name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>
                                Name: Z-A
                            </option>
                        </select>
                    </div>

                    <!-- Filters -->
                    <div class="space-y-6">
                        <!-- Car Type Filter -->
                        <div class="filter-section">
                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Car Type
                            </h4>
                            <div class="space-y-2">
                                <a href="{{ route('usercar.index') }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ !request('type') ? 'active' : '' }}">
                                    All Types
                                </a>
                                @foreach($carTypes as $type)
                                    <a href="{{ route('usercar.index') }}?type={{ urlencode($type) }}" 
                                        class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('type') == $type ? 'active' : '' }}">
                                        {{ $type }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Transmission Filter -->
                        <div class="filter-section">
                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Transmission
                            </h4>
                            <div class="space-y-2">
                                <a href="{{ request()->fullUrlWithQuery(['transmission' => '']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ !request('transmission') ? 'active' : '' }}">
                                    All Transmissions
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['transmission' => 'manual']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('transmission') == 'manual' ? 'active' : '' }}">
                                    Manual
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['transmission' => 'automatic']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('transmission') == 'automatic' ? 'active' : '' }}">
                                    Automatic
                                </a>
                            </div>
                        </div>

                        <!-- Capacity Filter -->
                        <div class="filter-section">
                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Capacity
                            </h4>
                            <div class="space-y-2">
                                <a href="{{ request()->fullUrlWithQuery(['capacity' => '']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ !request('capacity') ? 'active' : '' }}">
                                    Any Capacity
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['capacity' => '4']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('capacity') == '4' ? 'active' : '' }}">
                                    4 Seats
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['capacity' => '6']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('capacity') == '6' ? 'active' : '' }}">
                                    6 Seats
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['capacity' => '8']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('capacity') == '8' ? 'active' : '' }}">
                                    8+ Seats
                                </a>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter-section">
                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Price Range
                            </h4>
                            <div class="space-y-2">
                                <a href="{{ request()->fullUrlWithQuery(['price_range' => '']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ !request('price_range') ? 'active' : '' }}">
                                    All Prices
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['price_range' => 'low']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('price_range') == 'low' ? 'active' : '' }}">
                                    Under Rp 500K/day
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['price_range' => 'medium']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('price_range') == 'medium' ? 'active' : '' }}">
                                    Rp 500K - Rp 1M/day
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['price_range' => 'high']) }}" 
                                    class="block px-4 py-2 rounded-lg text-sm filter-item {{ request('price_range') == 'high' ? 'active' : '' }}">
                                    Above Rp 1M/day
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->query())
                        <div class="pt-6 border-t border-gray-200">
                            <a href="{{ route('usercar.index') }}" 
                                class="block w-full text-center px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors font-medium">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset All Filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Main Content - Cars Grid -->
            <div class="flex-1">
                <!-- Results Count -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $cars->total() }} {{ Str::plural('car', $cars->total()) }} found
                        @if(request()->query())
                            <span class="text-sm text-gray-500">• Filtered by: 
                                @foreach(request()->query() as $key => $value)
                                    {{ ucfirst($key) }}: {{ $value }}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        @endif
                    </h2>
                </div>

                <!-- Cars Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($cars as $car)
                        <div class="car-card bg-white overflow-hidden">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden">
                                <img loading="lazy" 
                                    src="{{ asset($car->image_car_1) }}" 
                                    alt="{{ $car->name_car }}"
                                    class="w-full h-full object-cover car-image">
                                
                                <!-- Status Badge -->
                                <span class="status-badge bg-{{ $car->car_status == 'available' ? 'green' : ($car->car_status == 'booked' ? 'yellow' : 'red') }}-500 text-white">
                                    {{ ucfirst($car->car_status) }}
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-bold text-gray-800 line-clamp-1">{{ $car->name_car }}</h3>
                                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                        {{ $car->car_type ?? 'General' }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-blue-600">Rp{{ number_format($car->price, 0, ',', '.') }}</span>
                                        <span class="text-sm text-gray-500">/day</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $car->capacity }} seats
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        </svg>
                                        {{ ucfirst($car->transmission) }}
                                    </span>
                                </div>

                                <!-- Rental Type Badge -->
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $car->rental_type ? 'bg-orange-100 text-orange-800' : 'bg-blue-100 text-blue-800' }}">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="{{ $car->rental_type ? 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' : 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z' }}" />
                                        </svg>
                                        {{ $car->rental_type ? 'With Driver' : 'Self Drive' }}
                                    </span>
                                </div>

                                <!-- Book Now Button -->
                                <a href="{{ route('car.detail', $car->slug) }}"
                                    class="w-full text-white py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105 flex items-center justify-center bg-primary hover:bg-blue-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span>Book Now</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="empty-state bg-white p-10 text-center rounded-2xl">
                                <div class="text-gray-400 mb-4">
                                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="10" width="18" height="7" rx="2" ry="2"/>
                                        <path d="M6 10L7 6h10l1 4"/>
                                        <path d="M7 17v2a2 2 0 0 1-4 0v-2"/>
                                        <path d="M21 17v2a2 2 0 0 1-4 0v-2"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-800 mb-2">No cars available</h3>
                                <p class="text-gray-600 mb-6">We're sorry, but there are no cars matching your criteria at the moment.</p>
                                
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="{{ route('usercar.index') }}"
                                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                        Reset Filters
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($cars->hasPages())
                    <div class="mt-8">
                        {{ $cars->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- WhatsApp Floating Button -->
    <a 
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20get%20some%20information%20about%20car%20rental%3A%0A-%20Preferred%20Car%20Type%3A%20%5BEnter%20type%5D%0A-%20Rental%20Dates%3A%20%5BEnter%20dates%5D%0A-%20Number%20of%20Passengers%3A%20%5BEnter%20number%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
        target="_blank"
        id="whatsapp-float"
        class="whatsapp-float fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 flex items-center gap-2 group animate-bounce-slow z-50"
    >
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 7.002 2.898a9.825 9.825 0 012.893 7.002c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.047 24l6.305-1.654a11.882 11.882 0 005.693 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
        <span class="whatsapp-text font-medium whitespace-nowrap">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
        <script src="{{ asset('assets/js/swiper.js') }}"></script>
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
        
        <script>
            // Filter accordion toggle
            document.querySelectorAll('.filter-section h4').forEach(header => {
                header.addEventListener('click', function() {
                    const section = this.parentElement;
                    section.classList.toggle('active');
                });
            });

            // Smooth scroll to top when changing filters
            document.querySelectorAll('.filter-item, .sort-dropdown').forEach(element => {
                element.addEventListener('click', function(e) {
                    if (e.target.tagName === 'A') {
                        e.preventDefault();
                        window.location.href = this.href;
                    }
                });
            });
        </script>
    @endpush
@endsection