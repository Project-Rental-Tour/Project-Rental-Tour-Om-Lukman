@extends('_layouts.user')

@section('head')
@endsection

@section('content')
    @include('components.client.navbar')
    <section class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Design Your Dream Trip</h1>
            <p class="text-xl md:text-2xl text-indigo-100 max-w-3xl mx-auto leading-relaxed">
                No package fits your dream? <br>
                Tell us your ideal destination, dates, and preferences —
                we’ll create a personalized travel experience just for you.
            </p>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-gray-50 py-4">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
                <li>/</li>
                <li class="text-gray-900">Custom Trip</li>
            </ol>
        </div>
    </nav>

    <!-- Custom Booking Form -->
    <section class="container mx-auto px-6 py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-8 py-6 border-b">
                <h2 class="text-2xl font-bold text-gray-800">Your Travel Preferences</h2>
                <p class="text-gray-600 mt-1">Fill in the details below. We’ll get back within 24 hours with a quote.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('booking.custom.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <!-- Desired Destinations -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Destinations You Want to Visit <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="custom_destinations" placeholder="e.g. Bali, Komodo, Lombok, Yogyakarta"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Separate with commas if multiple.</p>
                </div>

                <!-- Travel Date & Duration -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Preferred Travel Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="travel_date" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Duration (Nights) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="duration_nights" min="1" max="60" placeholder="e.g. 5"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                </div>

                <!-- Travelers -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Number of Travelers <span class="text-red-500">*</span>
                    </label>
                    <select name="travelers" required
                        class="w-full p-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500">
                        <option value="">Select number</option>
                        <option value="1">1 person</option>
                        <option value="2">2 people</option>
                        <option value="3">3 people</option>
                        <option value="4">4 people</option>
                        <option value="5">5 people</option>
                        <option value="6+">6 or more</option>
                    </select>
                </div>

                <!-- Budget Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Budget Range (per person)</label>
                    <select name="budget_range"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500">
                        <option value="">No preference</option>
                        <option value="Below Rp 3 juta">Below Rp 3 juta</option>
                        <option value="Rp 3 - 5 juta">Rp 3 - 5 juta</option>
                        <option value="Rp 5 - 8 juta">Rp 5 - 8 juta</option>
                        <option value="Rp 8 - 12 juta">Rp 8 - 12 juta</option>
                        <option value="Above Rp 12 juta">Above Rp 12 juta</option>
                    </select>
                </div>

                <!-- Interests / Activities -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        What Interests You? (Optional)
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['Adventure', 'Relaxation', 'Cultural', 'Honeymoon', 'Family', 'Photography', 'Food & Culinary', 'Trekking', 'Beach'] as $interest)
                            <label class="checkbox-group">
                                <input type="checkbox" name="interests[]" value="{{ $interest }}">
                                <span>{{ $interest }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="first_name" placeholder="John"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="last_name" placeholder="Doe"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" placeholder="you@example.com"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Country <span class="text-red-500">*</span>
                        </label>
                        <select name="country" required
                            class="w-full p-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500">
                            <option value="">Select country</option>
                            <option value="ID">Indonesia</option>
                            <option value="SG">Singapore</option>
                            <option value="MY">Malaysia</option>
                            <option value="TH">Thailand</option>
                            <option value="AU">Australia</option>
                            <option value="US">United States</option>
                            <option value="GB">United Kingdom</option>
                            <option value="DE">Germany</option>
                            <option value="JP">Japan</option>
                            <option value="KR">South Korea</option>
                            <option value="CN">China</option>
                            <option value="NL">Netherlands</option>
                        </select>
                    </div>
                </div>

                <!-- Special Request -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                    <textarea name="message" rows="4"
                        placeholder="Dietary needs, room preferences, activities you love, etc..."
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Tell us anything that matters to you.</p>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold py-4 px-8 rounded-lg text-lg transition transform hover:scale-105">
                        Send My Request
                    </button>
                    <p class="text-xs text-gray-500 text-center mt-3">
                        We’ll contact you within 24 hours with a personalized package and quote.
                    </p>
                </div>
            </form>
        </div>
    </section>

    @include('components.client.footer')
@endsection