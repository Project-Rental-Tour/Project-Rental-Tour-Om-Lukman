@extends('_layouts.user')

@section('head')
@endsection

@section('content')
    @include('components.client.navbar')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden bg-gray-900">
        <!-- Background Image -->
        <img src="{{ asset('assets/images/jumbotron/background-jumbo.png') }}" alt="Travel Destination"
            class="absolute inset-0 w-full h-full object-cover object-center opacity-70">

        <!-- Content -->
        <div class="container mx-auto px-6 relative z-20 text-center">
            <h1 class="text-7xl lg:text-8xl sm:text-4xl font-bold text-white mb-6 leading-19 sm:leading-tight">
                Let's Journey and<br>
                Discover a Place
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                ipsum has been the industry's standard dummy text ever since the 1500s.
            </p>
        </div>
    </section>

    <!-- About Section -->
    <section class="max-w-7xl mx-auto px-6 py-24">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            <!-- Text Content -->
            <div class="lg:w-1/2">
                <span
                    class="text-blue-600 text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block">
                    <i class="fas fa-compass mr-2"></i> OUR STORY
                </span>
                <h2 class="text-4xl font-bold text-gray-900 mt-6 mb-8 leading-tight">
                    Discover Our Journey<br>
                    With <span class="text-blue-600">Ann Trans</span>
                </h2>
                <p class="text-gray-700 leading-relaxed mb-10 text-lg">
                    For over a decade, Ann Trans has been creating unforgettable travel experiences. Our journey began with
                    a simple mission: to make world exploration accessible, enjoyable, and truly memorable for every
                    traveler.
                </p>

                <!-- Stats Section -->
                <div class="grid grid-cols-2 gap-6 mb-10">
                    <div class="stat-card bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-3xl font-bold text-blue-600 mb-2">15K+</div>
                        <div class="text-gray-600">Happy Travelers</div>
                    </div>
                    <div class="stat-card bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-3xl font-bold text-blue-600 mb-2">120+</div>
                        <div class="text-gray-600">Destinations</div>
                    </div>
                </div>

                <button
                    class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                    Explore Our Story
                    <i class="fas fa-arrow-right ml-3"></i>
                </button>
            </div>

            <!-- Image Grid -->
            <div class="lg:w-1/2 grid grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="relative h-full rounded-2xl overflow-hidden image-hover">
                        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.1&auto=format&fit=crop&w=500&q=80"
                            alt="Travel experience" class="w-full h-full object-cover rounded-2xl">
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 text-white">
                            <h3 class="font-bold text-xl">Memorable Journeys</h3>
                            <p class="text-sm opacity-90">Since 2010</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 grid gap-6">
                    <div class="relative h-full rounded-2xl overflow-hidden image-hover">
                        <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.1&auto=format&fit=crop&w=500&q=80"
                            alt="Nature view" class="w-full h-full object-cover rounded-2xl">
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 text-white">
                            <h3 class="font-bold">Natural Wonders</h3>
                        </div>
                    </div>
                    <div class="relative h-full rounded-2xl overflow-hidden image-hover">
                        <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?ixlib=rb-4.0.1&auto=format&fit=crop&w=500&q=80"
                            alt="Mountain adventure" class="w-full h-full object-cover rounded-2xl">
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 text-white">
                            <h3 class="font-bold">Adventure Awaits</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Destination Section -->
    <section class="max-w-7xl mx-auto px-6 py-24"> <!-- Increased py from 16 to 24 -->
        <div class="text-center mb-20">
            <span
                class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                Top selling
            </span>
            <h3 class="text-4xl font-bold text-gray-900 mb-6">
                Top Destination
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"> <!-- Increased gap from 6 to 8 -->
            {{-- Card 1 --}}
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col h-[350px]">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80"
                        alt="Bromo Tour"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full font-bold text-blue-600 shadow-md">
                        Rp. 3.650.000
                    </div>
                    <div
                        class="absolute bottom-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="far fa-clock mr-1"></i> 1 Day Tour
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Bromo Midnight Tour</h3>
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="text-sm">Bromo, East Java, Indonesia</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-hiking mr-1"></i> Moderate</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-camera mr-1"></i> Photography</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-car mr-1"></i> Transport</span>
                    </div>
                    <div class="mt-auto">
                        <button
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center shadow-md hover:shadow-lg">
                            <span>Book Now</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col h-[350px]">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1588666309990-d68f08e3d4a6?auto=format&fit=crop&w=600&q=80"
                        alt="Bromo Tumpak Sewu"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full font-bold text-blue-600 shadow-md">
                        Rp. 3.050.000
                    </div>
                    <div
                        class="absolute bottom-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="far fa-clock mr-1"></i> 2 Days 1 Night
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Bromo & Tumpak Sewu</h3>
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="text-sm">Bromo & Tumpak Sewu, Indonesia</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-water mr-1"></i> Waterfall</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-hiking mr-1"></i> Hiking</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-hotel mr-1"></i> Accommodation</span>
                    </div>
                    <div class="mt-auto">
                        <button
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center shadow-md hover:shadow-lg">
                            <span>Book Now</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col h-[350px]">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1541822920-8e1010aeab9b?auto=format&fit=crop&w=600&q=80"
                        alt="Bromo Ijen"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full font-bold text-blue-600 shadow-md">
                        Rp. 3.650.000
                    </div>
                    <div
                        class="absolute bottom-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="far fa-clock mr-1"></i> 3 Days 2 Nights
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Bromo, Tumpak Sewu & Ijen</h3>
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="text-sm">East Java, Indonesia</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-fire mr-1"></i> Blue Fire</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-water mr-1"></i> Waterfalls</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-mountain mr-1"></i> Volcano</span>
                    </div>
                    <div class="mt-auto">
                        <button
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center shadow-md hover:shadow-lg">
                            <span>Book Now</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col h-[350px]">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1590065480004-477ef6d4d5de?auto=format&fit=crop&w=600&q=80"
                        alt="Custom Trip"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div
                        class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full font-bold text-blue-600 shadow-md">
                        Custom
                    </div>
                    <div
                        class="absolute bottom-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="far fa-clock mr-1"></i> Flexible
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Custom Trip Package</h3>
                    <div class="flex items-center text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="text-sm">Your Preferred Destination</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-pen mr-1"></i> Personalized</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-calendar mr-1"></i> Flexible Dates</span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs"><i
                                class="fas fa-user-friends mr-1"></i> Any Group Size</span>
                    </div>
                    <div class="mt-auto">
                        <button
                            class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white py-3 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center shadow-md hover:shadow-lg">
                            <span>Customize Trip</span>
                            <i class="fas fa-magic ml-2 text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
    </section>

    <!-- Exploration Section -->
    <section class="max-w-7xl mx-auto px-6 py-24 bg-white rounded-2xl">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full">
                EXPLORASI BROMO MIDNIGHT & KAWAH IJEN
            </span>
            <h3 class="text-2xl font-bold text-gray-900 mt-4 mb-6">
                2 Hari 1 Malam - Wisata Alam Tropis & Petualangan Ringan
            </h3>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-10">
            <button
                class="bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center gap-2 shadow-md hover:bg-blue-700 transition-all duration-300 border-b-4 border-blue-800">
                <i class="fas fa-map-marked-alt"></i>
                <span>Maps & Location</span>
            </button>
            <button
                class="bg-gray-100 text-gray-800 px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-gray-200 transition-all duration-300 border-b-4 border-gray-300">
                <i class="fas fa-concierge-bell"></i>
                <span>Facilities</span>
            </button>
            <button
                class="bg-gray-100 text-gray-800 px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-gray-200 transition-all duration-300 border-b-4 border-gray-300">
                <i class="fas fa-calendar-day"></i>
                <span>Itinerary</span>
            </button>
            <button
                class="bg-gray-100 text-gray-800 px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-gray-200 transition-all duration-300 border-b-4 border-gray-300">
                <i class="fas fa-images"></i>
                <span>Gallery</span>
            </button>
        </div>

        <!-- Content Sections -->
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <!-- Maps Section -->
                <div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-6">
                        Thrill Above Ground: The Zip Line Adventure
                    </h4>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Embark on an exhilarating outdoor journey, zipping through lush landscapes,
                        feeling the wind rush past and experiencing nature from breathtaking heights.
                        Unleash your inner adventurer today.
                    </p>
                    <div class="bg-gray-100 p-6 rounded-xl mb-8">
                        <div class="bg-blue-50 rounded-lg h-64 flex items-center justify-center">
                            <i class="fas fa-map-marked-alt text-4xl text-blue-600"></i>
                            <span class="ml-3 text-blue-600 font-semibold">Interactive Map</span>
                        </div>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <div>
                                <span class="font-medium">Treetop Views</span>
                                <p class="text-gray-500 text-sm mt-1">Experience the forest from a unique perspective high
                                    above the ground</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <div>
                                <span class="font-medium">Adrenaline Rush</span>
                                <p class="text-gray-500 text-sm mt-1">Feel the excitement as you zip through the air at
                                    thrilling speeds</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <div>
                                <span class="font-medium">Safety Measures</span>
                                <p class="text-gray-500 text-sm mt-1">Professional guides and top-quality equipment ensure
                                    your safety</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <div>
                                <span class="font-medium">Nature Immersion</span>
                                <p class="text-gray-500 text-sm mt-1">Connect with nature in an exciting and unforgettable
                                    way</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Side Images -->
            <div class="lg:w-1/3 space-y-6">
                <div class="bg-gray-100 rounded-xl overflow-hidden h-64 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-image text-4xl text-blue-600 mb-3"></i>
                        <p class="text-blue-600 font-medium">Bromo Sunrise View</p>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-xl overflow-hidden h-64 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-mountain text-4xl text-green-600 mb-3"></i>
                        <p class="text-green-600 font-medium">Kawah Ijen Blue Fire</p>
                    </div>
                </div>
                <div class="p-5 bg-blue-50 rounded-xl">
                    <h5 class="font-semibold mb-3 text-blue-800">Quick Info</h5>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-clock text-blue-600 mr-3"></i>
                            <span class="text-sm">Duration: 2 Days 1 Night</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-users text-blue-600 mr-3"></i>
                            <span class="text-sm">Group Size: 4-10 People</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-walking text-blue-600 mr-3"></i>
                            <span class="text-sm">Difficulty: Moderate</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-cloud-sun text-blue-600 mr-3"></i>
                            <span class="text-sm">Best Time: April-October</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Additional Info Section -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 p-6 rounded-xl">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-600 p-3 rounded-full mr-4">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900">Location Details</h4>
                </div>
                <p class="text-gray-600 text-sm">East Java, Indonesia. The tour covers Mount Bromo and Kawah Ijen, two of
                    Java's most spectacular natural wonders.</p>
            </div>

            <div class="bg-green-50 p-6 rounded-xl">
                <div class="flex items-center mb-4">
                    <div class="bg-green-600 p-3 rounded-full mr-4">
                        <i class="fas fa-hiking text-white"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900">Physical Requirements</h4>
                </div>
                <p class="text-gray-600 text-sm">Moderate fitness level required. Includes hiking at high altitude and
                    walking on uneven terrain.</p>
            </div>

            <div class="bg-yellow-50 p-6 rounded-xl">
                <div class="flex items-center mb-4">
                    <div class="bg-yellow-600 p-3 rounded-full mr-4">
                        <i class="fas fa-utensils text-white"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900">Meals & Accommodation</h4>
                </div>
                <p class="text-gray-600 text-sm">1 night accommodation included. All meals during the tour provided (2
                    breakfasts, 1 lunch, 1 dinner).</p>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <button
                class="bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-calendar-check mr-2"></i> Book This Adventure Now
            </button>
            <p class="text-gray-500 text-sm mt-4">Limited spots available. Reserve your place today!</p>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="w-full py-24 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <span
                    class="text-primary text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                    OUR SUCCESS
                </span>
                <h3 class="text-4xl font-bold text-gray-900 mb-6">
                    Why Choose Ann Trans
                </h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Discover the exceptional travel experiences we offer with our premium services tailored to your needs.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                    <div class="flex items-start">
                        <div
                            class="bg-blue-100 p-3 rounded-full mr-4 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4
                                class="font-semibold text-xl mb-2 text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                                Worldwide Coverage</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                We provide tours and travel services worldwide with local expertise.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                    <div class="flex items-start">
                        <div
                            class="bg-yellow-100 p-3 rounded-full mr-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4
                                class="font-semibold text-xl mb-2 text-gray-900 group-hover:text-yellow-600 transition-colors duration-300">
                                Competitive Pricing</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Affordable prices with best value packages for all travelers.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                    <div class="flex items-start">
                        <div
                            class="bg-green-100 p-3 rounded-full mr-4 group-hover:bg-green-200 transition-colors duration-300">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4
                                class="font-semibold text-xl mb-2 text-gray-900 group-hover:text-green-600 transition-colors duration-300">
                                Fast Booking</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Quick and easy booking process with instant confirmation.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                    <div class="flex items-start">
                        <div
                            class="bg-purple-100 p-3 rounded-full mr-4 group-hover:bg-purple-200 transition-colors duration-300">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4
                                class="font-semibold text-xl mb-2 text-gray-900 group-hover:text-purple-600 transition-colors duration-300">
                                Guided Tours</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Experienced guides to enhance your travel experience.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                    <div class="flex items-start">
                        <div class="bg-red-100 p-3 rounded-full mr-4 group-hover:bg-red-200 transition-colors duration-300">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4
                                class="font-semibold text-xl mb-2 text-gray-900 group-hover:text-red-600 transition-colors duration-300">
                                Best Support 24/7</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Customer support available around the clock for your convenience.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div
                    class="bg-white p-5 rounded-xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                    <div class="flex items-start">
                        <div
                            class="bg-indigo-100 p-3 rounded-full mr-4 group-hover:bg-indigo-200 transition-colors duration-300">
                            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4
                                class="font-semibold text-xl mb-2 text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                                Ultimate Flexibility</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Flexible booking options and customizable travel plans.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
    </section>

    {{-- Galery Section --}}
    <section class="max-w-7xl mx-auto px-6 py-24">
        <div class="text-center mb-16">
            <span
                class="text-blue-600 text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full inline-block mb-4">
                Travel Moments
            </span>
            <h3 class="text-4xl font-bold text-gray-900 mb-4">
                Explore Our Gallery
            </h3>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover the beautiful moments and experiences we've captured from our journeys around the world.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 md:gap-7 xl:gap-8">
            <!-- Gallery item 1 -->
            <a href="#"
                class="gallery-item group relative flex h-48 items-end overflow-hidden rounded-2xl bg-gray-100 shadow-lg md:h-80">
                <img src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&q=75&fit=crop&w=600"
                    loading="lazy" alt="Beautiful mountain landscape"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-700 group-hover:scale-110" />

                <div class="gallery-overlay pointer-events-none absolute inset-0 opacity-80"></div>

                <div class="gallery-caption relative p-5 w-full">
                    <h4 class="text-xl font-bold text-white mb-1">Mountain Adventures</h4>
                    <p class="text-blue-100 text-sm">Explore breathtaking peaks</p>
                </div>
            </a>

            <!-- Gallery item 2 -->
            <a href="#"
                class="gallery-item group relative flex h-48 items-end overflow-hidden rounded-2xl bg-gray-100 shadow-lg md:col-span-2 md:h-80">
                <img src="https://images.unsplash.com/photo-1542759564-7ccbb6ac450a?auto=format&q=75&fit=crop&w=1000"
                    loading="lazy" alt="Tropical beach paradise"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-700 group-hover:scale-110" />

                <div class="gallery-overlay pointer-events-none absolute inset-0 opacity-80"></div>

                <div class="gallery-caption relative p-5 w-full">
                    <h4 class="text-xl font-bold text-white mb-1">Beach Getaways</h4>
                    <p class="text-blue-100 text-sm">Relax on pristine shores</p>
                </div>
            </a>

            <!-- Gallery item 3 -->
            <a href="#"
                class="gallery-item group relative flex h-48 items-end overflow-hidden rounded-2xl bg-gray-100 shadow-lg md:col-span-2 md:h-80">
                <img src="https://images.unsplash.com/photo-1610465299996-30f240ac2b1c?auto=format&q=75&fit=crop&w=1000"
                    loading="lazy" alt="Cultural city experience"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-700 group-hover:scale-110" />

                <div class="gallery-overlay pointer-events-none absolute inset-0 opacity-80"></div>

                <div class="gallery-caption relative p-5 w-full">
                    <h4 class="text-xl font-bold text-white mb-1">City Exploration</h4>
                    <p class="text-blue-100 text-sm">Discover urban wonders</p>
                </div>
            </a>

            <!-- Gallery item 4 -->
            <a href="#"
                class="gallery-item group relative flex h-48 items-end overflow-hidden rounded-2xl bg-gray-100 shadow-lg md:h-80">
                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&q=75&fit=crop&w=600"
                    loading="lazy" alt="Historical architecture"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-700 group-hover:scale-110" />

                <div class="gallery-overlay pointer-events-none absolute inset-0 opacity-80"></div>

                <div class="gallery-caption relative p-5 w-full">
                    <h4 class="text-xl font-bold text-white mb-1">Historical Sites</h4>
                    <p class="text-blue-100 text-sm">Journey through time</p>
                </div>
            </a>
        </div>

        <div class="text-center mt-16">
            <a href="#"
                class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md">
                View Full Gallery
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </div>
    </section>

    {{-- Blog Section --}}
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full">
                TRAVEL INSIGHTS
            </span>
            <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                Our Latest Blog Travel
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover travel tips, destination guides, and inspiring stories from our adventures around the world.
            </p>
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="category-filter active px-5 py-2 rounded-full bg-blue-100 text-blue-600 font-medium text-sm">
                All Articles
            </button>
            <button
                class="category-filter px-5 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200">
                Destinations
            </button>
            <button
                class="category-filter px-5 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200">
                Travel Tips
            </button>
            <button
                class="category-filter px-5 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200">
                Photography
            </button>
            <button
                class="category-filter px-5 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200">
                Culture
            </button>
        </div>

        <!-- Blog Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Blog Card 1 -->
            <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden">
                <div class="relative overflow-hidden h-56">
                    <div class="blog-image absolute inset-0 bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-mountain text-4xl text-blue-600"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span
                            class="bg-white text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Destinations</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <i class="far fa-calendar mr-2"></i>
                        <span>June 15, 2023</span>
                        <i class="far fa-clock ml-4 mr-2"></i>
                        <span>5 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Exploring the Majestic Bromo Volcano</h3>
                    <p class="text-gray-600 mb-5">Discover the breathtaking beauty of Mount Bromo and its surrounding
                        landscapes in East Java, Indonesia.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-600"></i>
                            </div>
                            <span class="text-sm font-medium">Sarah Johnson</span>
                        </div>
                        <a href="#" class="read-more text-blue-600 font-semibold text-sm flex items-center">
                            Read More
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 2 -->
            <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden">
                <div class="relative overflow-hidden h-56">
                    <div class="blog-image absolute inset-0 bg-green-100 flex items-center justify-center">
                        <i class="fas fa-camera text-4xl text-green-600"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span
                            class="bg-white text-green-600 text-xs font-semibold px-3 py-1 rounded-full">Photography</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <i class="far fa-calendar mr-2"></i>
                        <span>June 10, 2023</span>
                        <i class="far fa-clock ml-4 mr-2"></i>
                        <span>7 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">10 Tips for Capturing Stunning Travel Photos</h3>
                    <p class="text-gray-600 mb-5">Learn professional techniques to take amazing travel photos that tell
                        compelling stories.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-600"></i>
                            </div>
                            <span class="text-sm font-medium">Mike Taylor</span>
                        </div>
                        <a href="#" class="read-more text-blue-600 font-semibold text-sm flex items-center">
                            Read More
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 3 -->
            <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden">
                <div class="relative overflow-hidden h-56">
                    <div class="blog-image absolute inset-0 bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-utensils text-4xl text-yellow-600"></i>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-white text-yellow-600 text-xs font-semibold px-3 py-1 rounded-full">Culture</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <i class="far fa-calendar mr-2"></i>
                        <span>June 5, 2023</span>
                        <i class="far fa-clock ml-4 mr-2"></i>
                        <span>4 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">A Culinary Journey Through Southeast Asia</h3>
                    <p class="text-gray-600 mb-5">Explore the diverse and flavorful cuisine of Southeast Asia, from street
                        food to fine dining.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-600"></i>
                            </div>
                            <span class="text-sm font-medium">Lisa Chen</span>
                        </div>
                        <a href="#" class="read-more text-blue-600 font-semibold text-sm flex items-center">
                            Read More
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- View More Button -->
        <div class="text-center mt-12">
            <button
                class="bg-white text-blue-600 border border-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-md">
                View All Articles
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </section>


    <!-- Testimonials Section -->
    <section class="max-w-7xl mx-auto px-6 py-24">
        <div class="text-center mb-16">
            <span class="text-blue-600 text-sm font-semibold tracking-wider uppercase bg-blue-100 px-4 py-2 rounded-full">
                TESTIMONIALS
            </span>
            <h3 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                What People Say About Us
            </h3>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover why our customers love our services and how we've helped them achieve their travel dreams.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            <!-- Testimonial 1 -->
            <div class="testimonial-card bg-white p-8 rounded-xl shadow-xl relative">
                <div class="quote-icon">
                    <i class="fas fa-quote-left text-white text-xl"></i>
                </div>
                <div class="flex items-center mb-4">
                    <div class="flex">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-8 italic">
                    "You the Windows talking pointed posture will be exposed position side. Doer head upon ear when on
                    brow/vertail. Of balanced or diverted ears?"
                </p>
                <div class="flex items-center">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                        alt="Mike Taylor" class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-blue-500">
                    <div>
                        <h4 class="font-semibold text-gray-900">Mike Taylor</h4>
                        <p class="text-gray-500 text-sm">Lohman, Publishers</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-card bg-white p-8 rounded-xl shadow-xl relative">
                <div class="quote-icon">
                    <i class="fas fa-quote-left text-white text-xl"></i>
                </div>
                <div class="flex items-center mb-4">
                    <div class="flex">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-8 italic">
                    "On the Windows talking painted pasture yet its express parties use. Sure last upon he same as knew
                    next. Of believed or diverted no."
                </p>
                <div class="flex items-center">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                        alt="Chris Thomas" class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-blue-500">
                    <div>
                        <h4 class="font-semibold text-gray-900">Chris Thomas</h4>
                        <p class="text-gray-500 text-sm">CEO of Red Button</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-card bg-white p-8 rounded-xl shadow-xl relative">
                <div class="quote-icon">
                    <i class="fas fa-quote-left text-white text-xl"></i>
                </div>
                <div class="flex items-center mb-4">
                    <div class="flex">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-8 italic">
                    "The team at Adventure Tours made our trip to Bromo absolutely unforgettable. Their attention to detail
                    and knowledgeable guides made all the difference."
                </p>
                <div class="flex items-center">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=100&q=80"
                        alt="Sarah Johnson" class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-blue-500">
                    <div>
                        <h4 class="font-semibold text-gray-900">Sarah Johnson</h4>
                        <p class="text-gray-500 text-sm">Travel Blogger</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-20">
            <div class="stats-box text-center p-6 bg-white rounded-xl shadow-md">
                <div class="text-4xl font-bold text-blue-600 mb-2">5K+</div>
                <div class="text-gray-600">Happy Customers</div>
            </div>
            <div class="stats-box text-center p-6 bg-white rounded-xl shadow-md">
                <div class="text-4xl font-bold text-blue-600 mb-2">120+</div>
                <div class="text-gray-600">Destinations</div>
            </div>
            <div class="stats-box text-center p-6 bg-white rounded-xl shadow-md">
                <div class="text-4xl font-bold text-blue-600 mb-2">98%</div>
                <div class="text-gray-600">Satisfaction Rate</div>
            </div>
            <div class="stats-box text-center p-6 bg-white rounded-xl shadow-md">
                <div class="text-4xl font-bold text-blue-600 mb-2">15</div>
                <div class="text-gray-600">Years Experience</div>
            </div>
        </div>
    </section>
    @include('components.client.footer')

    @push('scripts')
        <script>
            // Simple navigation functionality
            document.addEventListener('DOMContentLoaded', function () {
                const dots = document.querySelectorAll('.nav-dot');

                dots.forEach(dot => {
                    dot.addEventListener('click', function () {
                        dots.forEach(d => d.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
            });
        </script>
    @endpush
@endsection