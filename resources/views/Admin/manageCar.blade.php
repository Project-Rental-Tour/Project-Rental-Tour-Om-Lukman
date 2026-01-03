@extends('_layouts.app')

@section('pageTitle', 'Manage Car')

@section('content')
    <div class="w-full">

        <div class="px-4 md:px-6 py-4 md:py-6 bg-white shadow-sm">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Manage Car</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage car data and information</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <div class="flex gap-2">
                        <button data-modal-target="add-car-modal" data-modal-toggle="add-car-modal"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Car
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white px-4 md:px-6 py-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                
                <div class="flex gap-2">
                    {{-- 1. Tombol Delete (Updated Class & Attributes) --}}
                    <button type="button"
                        class="bulk-action-btn px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-red-50 hover:text-red-700 flex items-center transition-colors shadow-sm"
                        data-route="{{ route('manage-car.bulk-destroy') }}" 
                        data-method="DELETE"
                        data-confirm-message="Are you sure you want to delete the selected cars?"
                        data-item-type="car">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete Selected
                    </button>

                    {{-- 2. Tombol Compress Images (BARU) --}}
                    <button type="button"
                        class="bulk-action-btn px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 flex items-center transition-colors shadow-sm"
                        data-route="{{ route('manage-car.bulk-compress') }}"
                        data-method="POST"
                        data-confirm-message="Compress images for selected cars? This might take a while."
                        data-item-type="car">
                        <i class="fa-solid fa-compress mr-2"></i>
                        Compress Images
                    </button>
                </div>

                <div class="relative">
                    <select onchange="window.location.href = '{{ route('manage-car.index') }}' + this.value"
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
                        <option value="?sort=price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>
                            Sort by: Price (Low to High)
                        </option>
                        <option value="?sort=price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>
                            Sort by: Price (High to Low)
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

            <div class="overflow-x-auto shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{-- Penting: Jangan ada name="ids[]" di checkbox header --}}
                                <input type="checkbox" id="select-all"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 bulk-checkbox"
                                    aria-label="Select all cars">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Capacity
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($cars->isEmpty())
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <rect x="3" y="10" width="18" height="7" rx="2" ry="2"/>
                                            <path d="M6 10L7 6h10l1 4"/>
                                            <path d="M7 17v2a2 2 0 0 1-4 0v-2"/>
                                            <path d="M21 17v2a2 2 0 0 1-4 0v-2"/>
                                        </svg>
                                        <h3 class="text-lg font-medium">No cars found</h3>
                                        <p class="mt-1 text-sm">
                                            @if(request()->filled('search'))
                                                No cars match your search for
                                                "<strong>{{ request('search') }}</strong>".
                                            @else
                                                No cars have been added yet.
                                            @endif
                                        </p>
                                        @if(request()->filled('search'))
                                            <button type="button"
                                                onclick="window.location.href='{{ route('manage-car.index') }}'"
                                                class="mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                                Reset Search
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($cars as $car)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- Checkbox Item dengan car_id --}}
                                        <input type="checkbox" name="ids[]" value="{{ $car->car_id }}"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 bulk-checkbox"
                                            aria-label="Select car: {{ $car->name_car }}">
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-gray-900">{{ $car->name_car }}</div>
                                        <div class="text-xs text-gray-500">{{ $car->slug }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($car->image_car_1)
                                            <img src="{{ asset($car->image_car_1) }}" alt="{{ $car->name_car }}"
                                                class="w-16 h-12 object-cover rounded mx-auto border">
                                        @else
                                            <span class="text-gray-400 text-xs">No image</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            {{ $car->car_type ?? '—' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($car->car_status == 'available') bg-green-100 text-green-800
                                            @elseif($car->car_status == 'booked') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($car->car_status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            Rp{{ number_format($car->price, 0, ',', '.') }}
                                        </div>
                                        <div class="text-xs text-gray-500">/ day</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $car->capacity }} seats
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium relative">
                                        <div class="inline-block relative">
                                            <button onclick="toggleMenu(this)" class="p-1 rounded-full hover:bg-gray-100 focus:outline-none">
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </button>
                                            <div class="absolute right-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 z-50 hidden">
                                                <ul class="py-1 text-sm">
                                                    <li>
                                                        <a data-modal-target="view-car-modal-{{ $car->car_id }}"
                                                            data-modal-toggle="view-car-modal-{{ $car->car_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            View Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-modal-target="edit-car-modal-{{ $car->car_id }}"
                                                            data-modal-toggle="edit-car-modal-{{ $car->car_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Edit Car
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-modal-target="delete-car-modal-{{ $car->car_id }}"
                                                            data-modal-toggle="delete-car-modal-{{ $car->car_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete Car
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

            <div class="mt-4">
                {{ $cars->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>


    <div id="add-car-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden  items-center justify-center w-full h-full  bg-opacity-50 backdrop-blur-sm overflow-y-auto">
        @include('components.admin.modal.modal-car.add-car')
    </div>

    {{-- Update Modal --}}
    @foreach ($cars as $car)
        <div id="edit-car-modal-{{ $car->car_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm overflow-y-auto">
            @include('components.admin.modal.modal-car.edit-car', ['car' => $car])
        </div>
    @endforeach


    {{-- Delete Modal --}}
    @foreach ($cars as $car)
        <div id="delete-car-modal-{{ $car->car_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm overflow-y-auto">
            @include('components.admin.modal.modal-car.delete-car', ['car' => $car])
        </div>
    @endforeach

    {{-- View Modal --}}
    @foreach ($cars as $car)
        <div id="view-car-modal-{{ $car->car_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm overflow-y-auto">
            @include('components.admin.modal.modal-car.view-car', ['car' => $car])
        </div>
    @endforeach
@endsection

@push('scripts')
    {{-- Pastikan bulkAction.js sudah diperbarui dengan versi terbaru --}}
    <script src="{{ asset('assets/js/bulkAction.js') }}"></script>
    <script src="{{ asset('assets/js/dropdownTable.js') }}"></script>
    <script src="{{ asset('assets/js/replaceImage.js') }}"></script>
@endpush