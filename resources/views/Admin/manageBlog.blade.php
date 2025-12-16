@extends('_layouts.app')

@section('pageTitle', 'Manage Blog')

@section('content')
    <div class="w-full">

        <div class="px-4 md:px-6 py-4 md:py-6 bg-white shadow-sm">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Manage Blog</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage articles, news, and updates</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <div class="flex gap-2">
                        <button data-modal-target="add-blog-modal" data-modal-toggle="add-blog-modal"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Post
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white px-4 md:px-6 py-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div class="flex gap-2">
                    <button type="button"
                        class="bulk-delete-btn px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 flex items-center"
                        data-route="{{ route('manage-blog.bulk-destroy') }}" data-item-type="blog">
                        <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete Selected
                    </button>
                </div>

                <div class="relative">
                    <select onchange="window.location.href = '{{ route('manage-blog.index') }}' + this.value"
                        class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 w-full md:w-auto">
                        <option value="?sort=newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                            Sort by: Newest
                        </option>
                        <option value="?sort=oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                            Sort by: Oldest
                        </option>
                        <option value="?sort=title-asc" {{ request('sort') == 'title-asc' ? 'selected' : '' }}>
                            Sort by: Title (A-Z)
                        </option>
                        <option value="?sort=title-desc" {{ request('sort') == 'title-desc' ? 'selected' : '' }}>
                            Sort by: Title (Z-A)
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
                                <input type="checkbox" id="select-all"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 bulk-checkbox"
                                    aria-label="Select all blogs">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Time Read
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Published
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($blogs->isEmpty())
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                        <h3 class="text-lg font-medium">No blog posts found</h3>
                                        <p class="mt-1 text-sm">
                                            @if(request()->filled('search'))
                                                No blogs match your search for
                                                "<strong>{{ request('search') }}</strong>".
                                            @else
                                                No blog posts have been created yet.
                                            @endif
                                        </p>
                                        @if(request()->filled('search'))
                                            <button type="button"
                                                onclick="window.location.href='{{ route('manage-blog.index') }}'"
                                                class="mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                                Reset Search
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($blogs as $blog)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="ids[]" value="{{ $blog->blog_id }}"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 bulk-checkbox"
                                            aria-label="Select blog: {{ $blog->title }}">
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($blog->title, 40) }}</div>
                                        <div class="text-xs text-gray-500">{{ $blog->slug }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($blog->image_path)
                                            <img src="{{ asset($blog->image_path) }}" alt="{{ $blog->title }}"
                                                class="w-16 h-12 object-cover rounded mx-auto border">
                                        @else
                                            <span class="text-gray-400 text-xs">No image</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            {{ $blog->category ?? 'General' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900">{{ $blog->time_read }} min</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ $blog->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $blog->created_at->format('H:i') }}
                                        </div>
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
                                                        <a data-modal-target="view-blog-modal-{{ $blog->blog_id }}"
                                                            data-modal-toggle="view-blog-modal-{{ $blog->blog_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            View Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-modal-target="edit-blog-modal-{{ $blog->blog_id }}"
                                                            data-modal-toggle="edit-blog-modal-{{ $blog->blog_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Edit Post
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-modal-target="delete-blog-modal-{{ $blog->blog_id }}"
                                                            data-modal-toggle="delete-blog-modal-{{ $blog->blog_id }}"
                                                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete Post
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
                {{ $blogs->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>


    <div id="add-blog-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden  items-center justify-center w-full h-full  bg-opacity-50 backdrop-blur-sm">
        @include('components.admin.modal.modal-blog.add-blog')
    </div>

    {{-- Update Modal --}}
    @foreach ($blogs as $blog)
        <div id="edit-blog-modal-{{ $blog->blog_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-blog.edit-blog', ['blog' => $blog])
        </div>
    @endforeach


    {{-- Delete Modal --}}
    @foreach ($blogs as $blog)
        <div id="delete-blog-modal-{{ $blog->blog_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-blog.delete-blog', ['blog' => $blog])
        </div>
    @endforeach

    {{-- View Modal --}}
    @foreach ($blogs as $blog)
        <div id="view-blog-modal-{{ $blog->blog_id }}" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full bg-opacity-50 backdrop-blur-sm">
            @include('components.admin.modal.modal-blog.view-blog', ['blog' => $blog])
        </div>
    @endforeach
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/bulkAction.js') }}"></script>
    <script src="{{ asset('assets/js/dropdownTable.js') }}"></script>
    <script src="{{ asset('assets/js/replaceImage.js') }}"></script>
@endpush