@extends('_layouts.app')

@section('pageTitle', 'Manage Destination')

@section('content')
    <div class="w-full">

        <!-- Header Section -->
        <div class="px-4 md:px-6 py-4 md:py-6 bg-white shadow-sm">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Manage Destination</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage data Destination dan Informasi Destination</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button data-modal-target="add-modal" data-modal-toggle="add-modal"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Destination
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Content Section -->
        <div class="bg-white px-4 md:px-6 py-4">
            <!-- Filter and Sort Row -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <!-- Left Side - Delete Selected Button -->
                <div class="flex gap-2">
                    <button
                        class="bulk-delete-btn px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 flex items-center"
                        data-route="{{ route('manage-user.bulk-destroy') }}">
                        <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete Selected
                    </button>
                </div>

                <!-- Right Side - Sort Dropdown -->
                <div class="relative">
                    <select
                        class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Sort by: Newest</option>
                        <option>Sort by: Oldest</option>
                        <option>Sort by: Name (A-Z)</option>
                        <option>Sort by: Name (Z-A)</option>
                        <option>Sort by: Salary (High-Low)</option>
                        <option>Sort by: Salary (Low-High)</option>
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

            <!-- User Table -->
            <div class="overflow-x-auto shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name Package
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Place
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Time
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Facility
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Employee Row 1 -->
                        @foreach ($destinations as $destination)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="selected_users[]" value="{{ $destination->destination_id }}"
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset($destination->destination_photo) }}"
                                        alt="{{ $destination->name_package }}" class="w-1/2 h-1/2 object-cover rounded mx-auto">
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">{{ $destination->name_package }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">{{ $destination->place }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">Rp.
                                        {{ number_format((float) $destination->price, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">{{ $destination->time }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-1 justify-center">
                                        @foreach(explode(',', $destination->facility) as $facility)
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700 mt-1">
                                                {{ trim($facility) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>


                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium relative text-center">
                                    <div class="inline-block relative">
                                        <button onclick="toggleMenu(this)" class="focus:outline-none">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <!-- Dropdown menu -->
                                        <div
                                            class="absolute right-0 mt-0 w-36 bg-white rounded-lg shadow-lg border border-gray-100 z-50 hidden transform translate-y-1">
                                            <ul class="py-2">
                                                <li>
                                                    <a data-modal-target="view-modal-{{ $destination->destination_id }}"
                                                        data-modal-toggle="view-modal-{{ $destination->destination_id }}"
                                                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fa-solid fa-eye mr-2 text-blue-500"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-modal-target="edit-modal-{{ $destination->destination_id }}"
                                                        data-modal-toggle="edit-modal-{{ $destination->destination_id }}"
                                                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fa-solid fa-pen-to-square mr-2 text-yellow-500"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-modal-target="delete-modal-{{ $destination->destination_id }}"
                                                        data-modal-toggle="delete-modal-{{ $destination->destination_id }}"
                                                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fa-solid fa-trash mr-2 text-red-500"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $destinations->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden  items-center justify-center w-full h-full  bg-opacity-50 backdrop-blur-sm">
        @include('components.admin.modal.modal-destination.add-destination')
    </div>

    {{-- Update Modal --}}
    @foreach ($destinations as $destination)
        <div id="edit-modal-{{ $destination->destination_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-destination.edit-destination', ['gallery' => $destination])
        </div>
    @endforeach


    {{-- Delete Modal --}}
    @foreach ($destinations as $destination)
        <!-- Delete Modal (unique ID for each user) -->
        <div id="delete-modal-{{ $destination->destination_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-destination.delete-destination', ['gallery' => $destination])
        </div>
    @endforeach

    {{-- View Modal --}}
    @foreach ($destinations as $destination)
        <div id="view-modal-{{ $destination->destination_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-destination.view-destination', ['gallery' => $destination])
        </div>
    @endforeach
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/bulkAction.js') }}"></script>
    <script src="{{ asset('assets/js/dropdownTable.js') }}"></script>
    <script src="{{ asset('assets/js/replaceImage.js') }}"></script>
    <script src="{{ asset('assets/js/destinationCurrency.js') }}"></script>
@endpush