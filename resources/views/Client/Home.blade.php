@extends('_layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
@endsection

@section('content')
                                @include('components.client.navbar')

                                <!-- Hero Section -->
                                <section id="jumbotron" class="relative h-screen flex items-center justify-center overflow-hidden bg-gray-900">
                                    <img 
                            src="{{ optional($profiles)->background_image
    ? asset(optional($profile)->background_image)
    : asset('assets/images/jumbotron/background-jumbo.png') }}" 
                            alt="Travel Destination"
                            class="absolute inset-0 w-full h-full object-cover object-center opacity-70 transition-opacity duration-500">

                                    <div class="container mx-auto px-6 relative z-20 text-center">
                                        <h1 class="text-6xl md:text-7xl font-bold text-white mb-6 leading-tight animate-fade-up">
                                            {{ optional($profiles)->jumbotron_heading ?? "Let's Journey and Discover a Place" }}
                                        </h1>
                                        <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto animate-fade-up" style="transition-delay: 0.2s">
                                            {{ optional($profiles)->jumbotron_subheading ?? "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s."}}
                                        </p>
                                        <a href="#destination"
                                        class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-primary rounded-full hover:bg-primary transition transform hover:scale-105 shadow-lg animate-fade-up"
                                        style="transition-delay: 0.4s">
                                            Explore Destinations
                                            <i class="fas fa-arrow-down ml-8 mt-1"></i>
                                        </a>
                                    </div>
                                </section>

                                <!-- About Section -->
                                <section class="max-w-7xl mx-auto px-6 py-24" id="about">
                                    <div class="flex flex-col lg:flex-row gap-16 items-center">
                                        <div class="lg:w-1/2 space-y-6 animate-fade-up">
                                            <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block">
                                                ABOUT US
                                            </span>
                                            <h3 class="text-4xl font-bold text-gray-900">{{ optional($profiles)->about_heading ?? "Your Journey, Our Passion"}}</h3>
                                            <p class="text-gray-600 leading-relaxed">
                                                {{ optional($profiles)->about_description ?? "With over 15 years of experience, we've crafted unforgettable journeys for thousands of travelers. 
                                                Our passion for exploration and cultural connection drives everything we do." }}
                                            </p>
                                            <ul class="space-y-3">
                                                @foreach(['Expert Local Guides', 'Best Price Guarantee', '24/7 Customer Support', 'Sustainable Travel'] as $item)
                                                    <li class="flex items-center text-gray-700">
                                                        <i class="fas fa-check text-blue-500 mr-3"></i> {{ $item }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <button class="bg-primary text-white px-8 py-4 rounded-xl hover:bg-primary transition flex items-center shadow-md hover:shadow-lg">
                                                Explore Our Story <i class="fas fa-arrow-right ml-3"></i>
                                            </button>
                                        </div>

                                        <!-- Image Grid -->
                                        <div class="lg:w-1/2 grid grid-cols-2 gap-6 animate-fade-up" style="transition-delay: 0.3s">
                                            @if($latestGalleries && $latestGalleries->count() > 0)
                                                @foreach ($latestGalleries as $index => $gallery)
                                                    @if ($index == 0)
                                                        <!-- Gambar 1 (col-span-1) -->
                                                        <div class="col-span-1">
                                                            <div class="relative h-full rounded-2xl overflow-hidden group">
                                                                <img src="{{ asset($gallery->gallery_photo) }}"
                                                                    alt="{{ $gallery->title }}"
                                                                    class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-500">
                                                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                            </div>
                                                        </div>
                                                    @elseif ($index == 1)
                                                        <!-- Gambar 2 (row-span-2) -->
                                                        <div class="row-span-2">
                                                            <div class="relative h-full rounded-2xl overflow-hidden group">
                                                                <img src="{{ asset($gallery->gallery_photo) }}"
                                                                    alt="{{ $gallery->title }}"
                                                                    class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-500">
                                                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <!-- Gambar 3 (col-span-1) -->
                                                        <div class="col-span-1">
                                                            <div class="relative h-full rounded-2xl overflow-hidden group">
                                                                <img src="{{ asset($gallery->gallery_photo) }}"
                                                                    alt="{{ $gallery->title }}"
                                                                    class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-500">
                                                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <!-- Fallback: Tampilkan gambar dari Unsplash -->
                                                <div class="col-span-1">
                                                    <div class="relative h-full rounded-2xl overflow-hidden group">
                                                        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=500&q=80"
                                                            alt="Travel experience"
                                                            class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-500">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                    </div>
                                                </div>
                                                <div class="row-span-2">
                                                    <div class="relative h-full rounded-2xl overflow-hidden group">
                                                        <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=500&q=80"
                                                            alt="Mountain adventure"
                                                            class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-500">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                    </div>
                                                </div>
                                                <div class="col-span-1">
                                                    <div class="relative h-full rounded-2xl overflow-hidden group">
                                                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=500&q=80"
                                                            alt="Beach sunset"
                                                            class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-500">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </section>

                                <!-- Top Destination Section -->
    <section id="destination" class="max-w-7xl mx-auto px-6 py-24">
        <div class="text-center mb-20 animate-fade-up">
            <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                Top Selling
            </span>
            <h3 class="text-4xl font-bold text-dark mb-6">Top Destinations</h3>
            <p class="text-dark max-w-2xl mx-auto">
                Choose from our most popular travel packages, carefully crafted for unforgettable experiences.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Destinasi Loop -->
            @foreach ($destinations as $destination)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col h-[350px] animate-fade-up" style="transition-delay: 0.1s">
                    <!-- Gambar -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset($destination->image ?? 'assets/images/placeholder.jpg') }}"
                             alt="{{ $destination->name_package }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Konten -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-dark mb-2">{{ $destination->name_package }}</h3>
                        <div class="flex items-center text-dark mb-4">
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                            <span class="text-sm">{{ $destination->place }}, Indonesia</span>
                        </div>

                        <!-- Aktivitas -->
                        <div class="flex flex-wrap gap-2 mb-5">
                            @foreach(explode(',', $destination->activities) as $activity)
                                @if(trim($activity))
                                    <span class="bg-dark/10 text-dark px-3 py-1 rounded-full text-xs">
                                        {{ trim($activity) }}
                                    </span>
                                @endif
                            @endforeach
                        </div>

                        <!-- Tombol Book Now -->
                        <div class="mt-auto">
                            <a href="{{ route('destination.show', $destination->slug) }}"
                               class="inline-flex items-center justify-between w-full px-8 py-3 text-lg font-medium text-light bg-primary rounded-lg hover-bg-primary transition duration-300">
                                <span>Book Now</span>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Custom Trip Card (bg-white, tapi tombol dan overlay berwarna menarik) -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col h-[350px] cursor-pointer group animate-fade-up" style="transition-delay: 0.4s"
                 onclick="window.location='{{ route('booking.custom') }}'">
                <!-- Gambar dengan overlay gelap -->
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80"
                         alt="Custom Trip"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <div class="text-center text-light">
                            <i class="fas fa-magic text-4xl mb-2 opacity-90 group-hover:scale-110 transition-transform"></i>
                            <h3 class="text-xl font-bold">Design Your Trip</h3>
                        </div>
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-dark mb-2">Create Your Own Adventure</h3>
                    <p class="text-dark/70 mb-5 text-sm">
                        No package fits? Tell us your dream destination and we’ll create a custom experience.
                    </p>

                    <!-- Fitur Custom -->
                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="bg-dark/10 text-dark px-3 py-1 rounded-full text-xs">
                            <i class="fas fa-pen mr-1"></i> Fully Custom
                        </span>
                        <span class="bg-dark/10 text-dark px-3 py-1 rounded-full text-xs">
                            <i class="fas fa-calendar mr-1"></i> Any Date
                        </span>
                        <span class="bg-dark/10 text-dark px-3 py-1 rounded-full text-xs">
                            <i class="fas fa-users mr-1"></i> Any Group
                        </span>
                    </div>

                    <!-- Tombol Customize Now -->
                    <div class="mt-auto">
                        <button class="w-full bg-darkGold text-light py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-warning group-hover:scale-105 flex items-center justify-center">
                            <span>Customize Now</span>
                            <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
                                <!-- Stats Section -->
                            <section class="max-w-7xl mx-auto px-6 py-24 text-center">
                                <div class="animate-fade-up mb-20">
                                    <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                                        KEY STATISTICS
                                    </span>
                                    <h3 class="text-4xl font-bold text-gray-900 mb-6">Trusted by Thousands</h3>
                                    <p class="text-gray-600 max-w-2xl mx-auto">
                                        Our success is measured by the smiles of our travelers and the milestones we've achieved together.
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                                    @foreach([
                                            ['300+', 'Happy Customers'],
                                            ['120+', 'Destinations'],
                                            ['98%', 'Satisfaction Rate'],
                                            ['15', 'Years Experience']
                                        ] as $index => $stat)
                                                                                                                                                                                                                                                                                                        <div class="stats-box text-center p-6 bg-white rounded-xl shadow-md animate-fade-up" style="transition-delay: {{ 0.1 + $index * 0.1 }}s">
                                                                                                                                                                                                                                                                                                            <div class="text-4xl font-bold text-primary mb-2" data-target="{{ $stat[0] }}">0</div>
                                                                                                                                                                                                                                                                                                            <div class="text-gray-600">{{ $stat[1] }}</div>
                                                                                                                                                                                                                                                                                                        </div>
                                    @endforeach
                                </div>
                            </section>

                                <!-- Why Choose Us Section -->
                                <section class="w-full py-24 bg-gradient-to-br from-gray-50 to-blue-50">
                                    <div class="max-w-7xl mx-auto px-6">
                                        <div class="text-center mb-20 animate-fade-up">
                                            <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                                                OUR SUCCESS
                                            </span>
                                            <h3 class="text-4xl font-bold text-gray-900 mb-6">Why Choose {{ optional($profiles)->website_name ?? "Ann Trans"}}</h3>
                                            <p class="text-gray-600 max-w-2xl mx-auto">
                                                Discover the exceptional travel experiences we offer with our premium services tailored to your needs.
                                            </p>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                                            @foreach([
                                                    ['Expert Local Guides', 'We partner with knowledgeable local guides who bring destinations to life with authentic stories and insights.', 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'blue'],
                                                    ['Competitive Pricing', 'Affordable prices with best value packages for all travelers.', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'yellow'],
                                                    ['24/7 Support', 'Round-the-clock customer service to assist you before, during, and after your journey.', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'green'],
                                                    ['Sustainable Travel', 'We promote eco-friendly practices and support local communities in every destination.', 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'red'],
                                                    ['Flexible Booking', 'Easy rescheduling and cancellation policies for peace of mind.', 'M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4', 'indigo'],
                                                    ['Ultimate Flexibility', 'Flexible booking options and customizable travel plans.', 'M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4', 'purple']
                                                ] as $feature)
                                                                                                                                                                                                                                                                                                                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group animate-fade-up" style="transition-delay: 0.1s">
                                                                                                                                                                                                                                                                                                                        <div class="flex items-start">
                                                                                                                                                                                                                                                                                                                            <div class="bg-{{ $feature[3] }}-100 p-3 rounded-full mr-4 group-hover:scale-110 transition-transform">
                                                                                                                                                                                                                                                                                                                                <svg class="w-7 h-7 text-{{ $feature[3] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature[2] }}"></path>
                                                                                                                                                                                                                                                                                                                                </svg>
                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                            <div>
                                                                                                                                                                                                                                                                                                                                <h4 class="font-semibold text-xl mb-2 text-gray-900 group-hover:text-{{ $feature[3] }}-600 transition-colors">{{ $feature[0] }}</h4>
                                                                                                                                                                                                                                                                                                                                <p class="text-gray-600 text-sm leading-relaxed">{{ $feature[1] }}</p>
                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                <!-- Gallery Section -->
                        <section class="max-w-7xl mx-auto px-6 py-24">
                            <!-- Header -->
                            <div class="text-center mb-16 animate-fade-up">
                                <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                                    Travel Moments
                                </span>
                                <h3 class="text-4xl font-bold text-gray-900 mb-4">
                                    Explore Our Gallery
                                </h3>
                                <p class="text-gray-600 max-w-2xl mx-auto">
                                    Discover the beautiful moments and experiences we've captured from our journeys around the world.
                                </p>
                            </div>

                            <!-- Masonry Grid -->
                            <div class="columns-2 md:columns-4 gap-4 space-y-4">
                                @foreach ($galleries as $gallery)
                                    <div class="relative overflow-hidden rounded-lg break-inside-avoid group">
                                        <img 
                                            src="{{ asset($gallery->gallery_photo) }}" 
                                            alt="{{ $gallery->title }}"
                                            class="w-full h-full rounded-lg object-auto transition-transform duration-300 group-hover:scale-105"
                                        />
                                        <!-- Overlay -->
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition"></div>
                                        <!-- Title -->
                                        <div class="absolute bottom-0 left-0 b p-2">
                                            <p class="text-white text-sm font-medium text-center">{{ $gallery->title }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>



                                <!-- Blog Section -->
                                <section class="max-w-7xl mx-auto px-6 py-16" id="blog">
                                    <div class="text-center mb-12 animate-fade-up">
                                        <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full">
                                            TRAVEL INSIGHTS
                                        </span>
                                        <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                                            Our Latest Blog Travel
                                        </h2>
                                        <p class="text-gray-600 max-w-2xl mx-auto">
                                            Discover travel tips, destination guides, and inspiring stories from our adventures around the world.
                                        </p>
                                    </div>

                                    <!-- Filter Buttons -->
                                    <div class="flex flex-wrap justify-center gap-4 mb-12">
                                        <button class="category-filter active px-5 py-2 rounded-full bg-blue-100 text-primary font-medium text-sm" 
                                                data-filter="all">All Articles</button>
                                        @foreach($types as $type)
                                            <button class="category-filter px-5 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200"
                                                    data-filter="{{ strtolower(str_replace(' & ', '-', $type)) }}">
                                                {{ $type }}
                                            </button>
                                        @endforeach
                                    </div>

                                    <!-- Blog Cards -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                        @forelse($blogs->take(3) as $blog)
                                            <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden animate-fade-up"
                                                data-type="{{ strtolower(str_replace(' & ', '-', $blog->type)) }}"
                                                style="transition-delay: 0.1s">
                                                <div class="relative overflow-hidden h-56">
                                                    @if($blog->featured_image)
                                                        <img src="{{ asset($blog->featured_image) }}" 
                                                            alt="{{ $blog->title }}" 
                                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                                    @else
                                                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                                                            <i class="fas fa-image text-4xl text-gray-400"></i>
                                                        </div>
                                                    @endif
                                                    <div class="absolute top-4 left-4">
                                                        <span class="bg-white text-primary text-xs font-semibold px-3 py-1 rounded-full">
                                                            {{ $blog->type }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="p-6">
                                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                                        <i class="far fa-calendar mr-2"></i>
                                                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                                        <i class="far fa-clock ml-4 mr-2"></i>
                                                        <span>{{ $blog->reading_time }} min read</span>
                                                    </div>
                                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $blog->title }}</h3>
                                                    <p class="text-gray-600 mb-5 line-clamp-3">{!! Str::limit(strip_tags($blog->content), 100) !!}</p>
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center">
                                                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                                                <i class="fas fa-user text-gray-600"></i>
                                                            </div>
                                                            <span class="text-sm font-medium">{{ $blog->author }}</span>
                                                        </div>
                                                        <a href="{{ route('blog.detail-blog', $blog->slug) }}" 
                                                        class="text-primary font-semibold text-sm flex items-center hover:underline">
                                                            Read More 
                                                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-span-full text-center py-10">
                                                <i class="fas fa-blog text-6xl text-gray-300 mb-4"></i>
                                                <p class="text-gray-500 text-lg">No blog posts available.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </section>

                        <!-- Testimonials Section -->
                                <section class="max-w-7xl mx-auto px-6 py-24">
                                    <div class="text-center mb-8 animate-fade-up">
                                        <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full">
                                            TESTIMONIALS
                                        </span>
                                        <h3 class="text-4xl font-bold text-gray-900 mt-4 mb-6">What People About Us</h3>
                                        <p class="text-gray-600 max-w-2xl mx-auto">
                                            Discover why our customers love our services and how we've helped  them achieve their travel dreams.
                                        </p>
                                    </div>

                                    <!-- Swiper Container -->
                                    <div class="swiper testimonial-swiper">
                                        <div class="swiper-wrapper">
                                            @foreach($testimonials as $testimoni)
                                                <div class="swiper-slide px-4 py-8">
                                                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex flex-col min-h-[330px] h-full">
                                                        <div class="mb-4 text-blue-500 self-start">
                                                            <i class="fas fa-quote-left text-2xl opacity-80"></i>
                                                        </div>

                                                        <!-- Rating -->
                                                        <div class="flex items-center justify-center mb-4 text-yellow-400">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $testimoni->rating)
                                                                    <i class="fas fa-star text-sm"></i>
                                                                @else
                                                                    <i class="far fa-star text-sm text-gray-300"></i>
                                                                @endif
                                                            @endfor
                                                        </div>

                                                        <!-- Testimonial -->
                                                        <p class="text-gray-600 italic flex-grow leading-relaxed text-sm text-center">
                                                            {{ $testimoni->content }}
                                                        </p>

                                                        <!-- Profile -->
                                                        <div class="mt-auto text-center w-full">

                                                                <div>
                                                                    <h4 class="font-semibold text-gray-900 text-sm">{{ $testimoni->name }}</h4>
                                                                    <p class="text-gray-500 text-xs">{{ $testimoni->role }}, {{ $testimoni->location }}</p>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                <!-- Booking Process Section -->
                    <section class="max-w-7xl mx-auto px-6 py-24" id="booking-process">
                <div class="text-center mb-20 animate-fade-up">
                    <span class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                        HOW TO BOOK
                    </span>
                    <h3 class="text-4xl font-bold text-dark mb-6">Easy Booking Process</h3>
                    <p class="text-dark max-w-2xl mx-auto">
                        Whether you choose a ready-made package or create your own adventure, booking with us is simple and hassle-free.
                    </p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Regular Booking -->
                    <div class="bg-light p-8 rounded-2xl shadow-lg border border-dark/10 animate-fade-up" style="transition-delay: 0.2s">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-box text-primary"></i>
                            </div>
                            <h4 class="text-2xl font-bold text-dark">Regular Package</h4>
                        </div>
                        <p class="text-dark mb-6">Choose from our curated destinations and book in just a few steps.</p>
                        <ol class="space-y-5">
                            @foreach(['Choose Destination', 'View Details', 'Fill Out Booking Form', 'Submit & Wait for Confirmation'] as $i => $step)
                                <li class="flex items-start">
                                    <div class="bg-primary text-light rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-4 mt-1">{{ $i + 1 }}</div>
                                    <div>
                                        <strong>{{ $step }}</strong>
                                        <p class="text-dark/70 text-sm">Step details for {{ strtolower($step) }}.</p>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <a href="#destination"
                           class="mt-6 inline-flex items-center px-6 py-3 bg-primary text-light font-semibold rounded-lg hover-bg-primary transition w-full justify-center shadow-md hover:shadow-lg">
                            Explore Destinations <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Custom Booking -->
                    <div class="bg-primary text-light p-8 rounded-2xl shadow-lg animate-fade-up" style="transition-delay: 0.4s">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-light/20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-magic text-lg text-light"></i>
                            </div>
                            <h4 class="text-2xl font-bold">Custom Trip</h4>
                        </div>
                        <p class="mb-6 text-light/80">Want something unique? Tell us your dream trip and we’ll make it happen.</p>
                        <ol class="space-y-5">
                            @foreach(['Select Custom Option', 'Fill Out Custom Form', 'Submit Request', 'Wait for Follow-Up'] as $i => $step)
                                <li class="flex items-start">
                                    <div class="bg-light text-primary rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-4 mt-1">{{ $i + 1 }}</div>
                                    <div>
                                        <strong>{{ $step }}</strong>
                                        <p class="text-light/70 text-sm">Submit your idea and let us craft your perfect itinerary.</p>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <a href="{{ route('booking.custom') }}"
                           class="mt-6 inline-flex items-center px-6 py-3 bg-light text-primary font-semibold rounded-lg hover:bg-light/80 transition w-full justify-center shadow-md hover:shadow-lg">
                            Customize Your Trip <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </section>

                                <a 
                                    href="https://wa.me/6281234567890" 
                                    target="_blank"
                                    id="whatsapp-float"
                                    class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group"
                                >
                                    <i class="fab fa-whatsapp text-2xl"></i>
                                    <span class="whatsapp-text text-white font-medium whitespace-nowrap ml-1 mt-0.5">Need Help ?</span>
                                </a>
                            @include('components.client.footer')

                            @push('scripts')
                                <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
                                <script src="{{ asset('assets/js/swiper.js') }}"></script>
                                <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
                                <script src="{{ asset('assets/js/smoothScroll.js') }}"></script>
                                <script src="{{ asset('assets/js/stats.js')}}"></script>
                                <script src="{{ asset('assets/js/filterBlogTravel.js') }}"></script>
                            @endpush
@endsection