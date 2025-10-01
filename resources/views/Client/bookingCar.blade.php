@extends('_layouts.user')

@section('content')
    @include('components.client.navbar')

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white h-96" id="jumbotron">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <img loading="lazy" src="{{ asset($car->image_car_1) }}" alt="{{ $car->name_car }}"
            class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl">
                    <span class="bg-blue-600 text-white text-sm px-3 py-1 rounded-full mb-4 inline-block">
                        {{ ucfirst($car->car_type ?? 'General') }} Car
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $car->name_car }}</h1>
                    <p class="text-xl text-blue-200 mb-6">
                        {{ $car->capacity }} seats • {{ ucfirst($car->transmission) }} Transmission
                    </p>
                    <div class="flex flex-wrap items-center gap-6 text-lg">
                        <span class="font-bold text-yellow-300 text-2xl">
                            Rp{{ number_format($car->price, 0, ',', '.') }} <span
                                class="text-sm font-normal">/day</span>
                        </span>
                        <span class="bg-{{ $car->car_status == 'available' ? 'green' : 'red' }}-600 px-3 py-1 rounded-md text-sm text-white">
                            {{ ucfirst($car->car_status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-white py-4 shadow-sm">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('index') }}" class="hover:text-blue-600">Home</a></li>
                <li class="text-gray-400">/</li>
                <li><a href="{{ route('usercar.index') }}" class="hover:text-blue-600">Cars</a></li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-900">{{ $car->name_car }}</li>
            </ol>
        </div>
    </nav>

    <!-- Booking Form -->
    <section class="container mx-auto px-6 py-12">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-6">
                <h2 class="text-2xl font-bold">Complete Your Car Booking</h2>
                <p class="text-blue-100">Fill in your details to confirm your rental.</p>
            </div>

            <form action="{{ route('bookingStore') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Hidden: Car ID -->
                <input type="hidden" name="car_id" value="{{ $car->car_id }}">

                <!-- Car Info -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800">{{ $car->name_car }}</h3>
                    <p class="text-gray-600">{{ $car->car_type ?? 'General' }} • {{ ucfirst($car->transmission) }} • {{ $car->capacity }} seats</p>
                    <p class="text-lg font-bold text-blue-600 mt-1">
                        Rp{{ number_format($car->price, 0, ',', '.') }} / day
                    </p>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Name -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="customer_name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter your full name" value="{{ old('customer_name') }}">
                        @error('customer_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email (Optional)</label>
                        <input type="email" name="customer_email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter your email" value="{{ old('customer_email') }}">
                        @error('customer_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <!-- Country Code -->
                            <select name="country_code" id="country_code"
                                class="w-1/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required>
                                <option value="" disabled selected>Select Code</option>
                                <option value="+62" selected>+62 (ID) – Indonesia</option>
                                <option value="+60">+60 (MY) – Malaysia</option>
                                <option value="+65">+65 (SG) – Singapore</option>
                                <option value="+66">+66 (TH) – Thailand</option>
                                <option value="+81">+81 (JP) – Japan</option>
                                <option value="+82">+82 (KR) – South Korea</option>
                                <option value="+86">+86 (CN) – China</option>
                                <option value="+1">+1 (US) – United States</option>
                                <option value="+44">+44 (UK) – United Kingdom</option>
                                <option value="+49">+49 (DE) – Germany</option>
                                <option value="+33">+33 (FR) – France</option>
                                <option value="+39">+39 (IT) – Italy</option>
                                <option value="+34">+34 (ES) – Spain</option>
                                <option value="+41">+41 (CH) – Switzerland</option>
                                <option value="+90">+90 (TR) – Turkey</option>
                            </select>

                            <!-- Phone Number -->
                            <input type="tel" name="customer_phone" placeholder="81234567890"
                                class="w-3/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required value="{{ old('customer_phone') }}">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">
                            Enter your number without "+" or "0" at the beginning.
                            Example: <code class="bg-gray-100 px-1 py-0.5 rounded">81234567890</code>
                        </p>
                        @error('customer_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Rental Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            min="{{ now()->format('Y-m-d') }}">
                        @error('start_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            min="{{ now()->addDay()->format('Y-m-d') }}">
                        @error('end_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Rental Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rental Type</label>
                    <div class="flex items-center space-x-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="rental_type" value="0" class="form-radio" {{ old('rental_type', $car->rental_type == false) ? 'checked' : '' }}>
                            <span class="ml-2">Standard (Self Drive)</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="rental_type" value="1" class="form-radio" {{ old('rental_type', $car->rental_type == true) ? 'checked' : '' }}>
                            <span class="ml-2">With Driver</span>
                        </label>
                    </div>
                    @error('rental_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Request (Optional)</label>
                    <textarea name="notes" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="e.g., Child seat needed, specific pickup location...">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Calculation -->
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <h4 class="font-semibold text-blue-800 mb-2">Price Summary</h4>
                    <div class="space-y-1 text-sm">
                        <div class="flex justify-between">
                            <span>Price per day:</span>
                            <span>Rp{{ number_format($car->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Duration:</span>
                            <span id="duration-days">0 days</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg text-blue-600 pt-2 border-t">
                            <span>Total Price:</span>
                            <span id="total-price">Rp0</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('car.detail', $car->slug) }}" class="w-full sm:w-auto text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg
                        hover:bg-gray-50 transition">
                        Back to Car Details
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- WhatsApp Floating Button -->
    <a 
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20get%20some%20information%3A%0A-%20Destination%3A%20%5BEnter%20your%20preferred%20destination%5D%0A-%20Number%20of%20Travelers%3A%20%5BEnter%20number%5D%0A-%20Travel%20Date%3A%20%5BEnter%20date%5D%0A-%20Email%3A%20%5BEnter%20your%20email%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
        target="_blank"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group animate-bounce-slow"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium whitespace-nowrap">Need Help?</span>
    </a>

    @include('components.client.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const startDateInput = document.querySelector('input[name="start_date"]');
                const endDateInput = document.querySelector('input[name="end_date"]');
                const durationElement = document.getElementById('duration-days');
                const totalElement = document.getElementById('total-price');
                const carPrice = {{ $car->price }};

                function calculatePrice() {
                    if (!startDateInput.value || !endDateInput.value) {
                        durationElement.textContent = '0 days';
                        totalElement.textContent = 'Rp0';
                        return;
                    }

                    const startDate = new Date(startDateInput.value);
                    const endDate = new Date(endDateInput.value);
                    
                    if (endDate <= startDate) {
                        durationElement.textContent = '0 days';
                        totalElement.textContent = 'Rp0';
                        return;
                    }

                    const diffTime = Math.abs(endDate - startDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    durationElement.textContent = diffDays + ' days';
                    totalElement.textContent = 'Rp' + (diffDays * carPrice).toLocaleString('id-ID');
                }

                startDateInput.addEventListener('change', calculatePrice);
                endDateInput.addEventListener('change', calculatePrice);
            });
        </script>
    @endpush
@endsection