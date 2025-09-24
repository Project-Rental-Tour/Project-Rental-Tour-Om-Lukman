@extends('_layouts.app')

@section('pageTitle', 'Manage Booking Car')

@section('content')
    <div class="w-full">

        <!-- Header Section -->
        <div class="px-4 md:px-6 py-4 md:py-6 bg-white shadow-sm">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Manage Booking Car</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage car booking data and information</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <!-- Action Buttons -->
                    
                </div>
            </div>
        </div>

        <!-- Filter and Content Section -->
        <div class="bg-white px-4 md:px-6 py-4">
            <!-- Filter and Sort Row -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <!-- Left Side - Delete Selected Button -->
                <div class="flex gap-2">
                    <button type="button"
                        class="bulk-delete-btn px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 flex items-center"
                        data-route="{{ route('manage-booking-car.bulk-destroy') }}" data-item-type="booking">
                        <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete Selected
                    </button>
                </div>

                <!-- Right Side - Sort & Filter Dropdowns -->
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <!-- Sort -->
                    <div class="relative">
                        <select onchange="window.location.href = '{{ route('manage-booking-car.index') }}' + this.value"
                            class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 w-full md:w-auto">
                            <option value="?sort=newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                Sort by: Newest
                            </option>
                            <option value="?sort=oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                Sort by: Oldest
                            </option>
                            <option value="?sort=name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>
                                Sort by: Name (A-Z)
                            </option>
                            <option value="?sort=name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>
                                Sort by: Name (Z-A)
                            </option>
                            <option value="?sort=date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>
                                Sort by: Date (Asc)
                            </option>
                            <option value="?sort=date-desc" {{ request('sort') == 'date-desc' ? 'selected' : '' }}>
                                Sort by: Date (Desc)
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Filter Status -->
                    <div class="relative">
                        <select onchange="window.location.href = this.value"
                            class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 w-full md:w-auto">
                            <option value="{{ route('manage-booking-car.index') }}?status=" {{ !request('status') ? 'selected' : '' }}>
                                All Status
                            </option>
                            <option value="{{ route('manage-booking-car.index') }}?status=pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="{{ route('manage-booking-car.index') }}?status=confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>
                            <option value="{{ route('manage-booking-car.index') }}?status=cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Table -->
            <div class="overflow-x-auto shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 bulk-checkbox"
                                    aria-label="Select all bookings">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Car
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dates
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Price
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($bookings->isEmpty())
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <h3 class="text-lg font-medium">No bookings found</h3>
                                        <p class="mt-1 text-sm">
                                            @if(request()->filled('search'))
                                                No bookings match your search for
                                                "<strong>{{ request('search') }}</strong>".
                                            @else
                                                No car bookings have been made yet.
                                            @endif
                                        </p>
                                        @if(request()->filled('search'))
                                            <button type="button"
                                                onclick="window.location.href='{{ route('manage-booking-car.index') }}'"
                                                class="mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                                Reset Search
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($bookings as $booking)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="ids[]" value="{{ $booking->booking_cars_id }}"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 bulk-checkbox"
                                            aria-label="Select booking: {{ $booking->customer_name }}">
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-gray-900">{{ $booking->customer_name }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ $booking->customer_phone }}
                                            @if($booking->customer_email)
                                                <br>{{ $booking->customer_email }}
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $booking->car->name_car }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $booking->car->car_type ?? '—' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            to {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $booking->duration_days }} days
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($booking->booking_status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->booking_status == 'confirmed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($booking->booking_status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium relative">
                                        <div class="inline-block relative">
                                            <button onclick="toggleMenu(this)" class="p-1 rounded-full hover:bg-gray-100 focus:outline-none">
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </button>
                                            <!-- Dropdown menu -->
                                            <div class="absolute right-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 z-50 hidden">
                                                <ul class="py-1 text-sm">
                                                    <li>
                                                        <a data-modal-target="view-booking-modal-{{ $booking->booking_cars_id }}"
                                                            data-modal-toggle="view-booking-modal-{{ $booking->booking_cars_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            View Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-modal-target="edit-booking-modal-{{ $booking->booking_cars_id }}"
                                                            data-modal-toggle="edit-booking-modal-{{ $booking->booking_cars_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Edit Booking
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-modal-target="delete-booking-modal-{{ $booking->booking_cars_id }}"
                                                            data-modal-toggle="delete-booking-modal-{{ $booking->booking_cars_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete Booking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $bookings->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>



    {{-- View Modals --}}
    @foreach ($bookings as $booking)
        <div id="view-booking-modal-{{ $booking->booking_cars_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-black bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-booking-car.view-booking-car', ['booking' => $booking])
        </div>
    @endforeach
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/bulkAction.js') }}"></script>
    <script>
        function toggleMenu(button) {
            const dropdown = button.nextElementSibling;
            document.querySelectorAll('.absolute').forEach(el => {
                if (el !== dropdown) el.classList.add('hidden');
            });
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('.absolute').forEach(el => el.classList.add('hidden'));
            }
        });
    </script>
@endpush