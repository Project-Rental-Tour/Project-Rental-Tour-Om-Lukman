@extends('_layouts.app')

@section('content')
    <div class="w-full">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Header Section -->
        <div class="px-4 md:px-6 py-4 md:py-6 bg-white shadow-sm">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Manage Blog</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage data Karyawan dan Informasi Karyawan</p>
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
                            Tambah Karyawan
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
                                Title
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Content
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Slug
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Employee Row 1 -->
                        @foreach ($blogPosts as $blogPost)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="selected_users[]" value="{{ $blogPost->blog_post_id }}"
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $blogPost->featured_image) }}"
                                        alt="{{ $blogPost->name_package }}" class="w-1/8 h-1/8 object-cover rounded mx-auto">
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">{{ $blogPost->title }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">{{ $blogPost->content }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">{{$blogPost->slug}}</div>
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
                                                    <a data-modal-target="view-modal-{{ $blogPost->blog_post_id }}"
                                                        data-modal-toggle="view-modal-{{ $blogPost->blog_post_id }}"
                                                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fa-solid fa-eye mr-2 text-blue-500"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-modal-target="edit-modal-{{ $blogPost->blog_post_id }}"
                                                        data-modal-toggle="edit-modal-{{ $blogPost->blog_post_id }}"
                                                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fa-solid fa-pen-to-square mr-2 text-yellow-500"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-modal-target="delete-modal-{{ $blogPost->blog_post_id }}"
                                                        data-modal-toggle="delete-modal-{{ $blogPost->blog_post_id }}"
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
            <div class="flex items-center justify-between px-6 py-3 bg-white border-t border-gray-200">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="#"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </a>
                    <a href="#"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span
                                class="font-medium">97</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" aria-current="page"
                                class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                1
                            </a>
                            <a href="#"
                                class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                2
                            </a>
                            <a href="#"
                                class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                3
                            </a>
                            <span
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                ...
                            </span>
                            <a href="#"
                                class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                8
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden  items-center justify-center w-full h-full  bg-opacity-50 backdrop-blur-sm">
        @include('components.admin.modal.modal-blog.add-blog')
    </div>

    {{-- Update Modal --}}
    @foreach ($blogPosts as $blogPost)
        <div id="edit-modal-{{ $blogPost->blog_post_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-blog.edit-blog', ['blogPost' => $blogPost])
        </div>
    @endforeach


    {{-- Delete Modal --}}
    @foreach ($blogPosts as $blogPost)
        <!-- Delete Modal (unique ID for each user) -->
        <div id="delete-modal-{{ $blogPost->blog_post_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-blog.delete-blog', ['blogPost' => $blogPost])
        </div>
    @endforeach

    {{-- View Modal --}}
    @foreach ($blogPosts as $blogPost)
        <div id="view-modal-{{ $blogPost->blog_post_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-blog.view-blog', ['blogPost' => $blogPost])
        </div>
    @endforeach
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/bulkAction.js') }}"></script>
    <script src="{{ asset('assets/js/dropdownTable.js') }}"></script>
    <script src="{{ asset('assets/js/replaceImage.js') }}"></script>
    <script src="{{ asset('assets/js/destinationCurrency.js') }}"></script>
@endpush