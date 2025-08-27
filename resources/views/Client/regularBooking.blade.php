@extends('_layouts.user')

@section('content')
    @include('components.client.navbar')

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white" id="jumbotron">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <img src="{{ asset($destination->destination_photo) }}" alt="{{ $destination->name_package }}"
            class="w-full h-72 object-cover object-center md:h-80">

        <div class="relative container mx-auto px-6 py-16">
            <h1 class="text-3xl md:text-4xl font-bold">Booking: {{ $destination->name_package }}</h1>
            <p class="text-blue-200 mt-2">{{ $destination->place }} • {{ $destination->time }}</p>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-white py-4 shadow-sm">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li>Home</li>
                <li class="text-gray-400">/</li>
                <li>Destinations</li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-900">{{ $destination->name_package }}</li>
            </ol>
        </div>
    </nav>

    <!-- Booking Form -->
    <section class="container mx-auto px-6 py-12">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-6">
                <h2 class="text-2xl font-bold">Complete Your Booking</h2>
                <p class="text-blue-100">Fill in your details to confirm your trip.</p>
            </div>

            <form action="{{ route('booking.regular.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Hidden Input: Destination ID -->
                <input type="hidden" name="destination_id" value="{{ $destination->destination_id }}">

                <!-- Destination Info -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800">{{ $destination->name_package }}</h3>
                    <p class="text-gray-600">{{ $destination->place }} • {{ $destination->time }}</p>
                    <p class="text-lg font-bold text-blue-600 mt-1">
                        Rp{{ number_format($destination->price, 0, ',', '.') }} / person
                    </p>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="first_name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg  focus:border-transparent"
                            placeholder="Enter your first name">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" name="last_name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg  focus:border-transparent"
                            placeholder="Enter your last name">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg  focus:border-transparent"
                            placeholder="Enter your email">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <input type="text" name="country" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg  focus:border-transparent"
                            placeholder="Enter your country">
                        @error('country')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Travel Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Travel Date</label>
                    <input type="date" name="travel_date" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg  focus:border-transparent"
                        min="{{ now()->format('Y-m-d') }}">
                    @error('travel_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Request (Optional)</label>
                    <textarea name="message" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg  focus:border-transparent"
                        placeholder="e.g., Dietary preferences, accessibility needs..."></textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('destination.show', $destination->slug) }}"
                        class="w-full sm:w-auto text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Back to Details
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </section>

    @include('components.client.footer')
@endsection