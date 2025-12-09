<div class="relative w-full max-w-4xl px-4 slide-down">
    <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-gray-50 z-10">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Article Preview</h3>
                <div class="flex items-center mt-2 space-x-3 text-sm">
                    <span class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700 font-medium text-xs">{{ $blog->category }}</span>
                    <span class="text-gray-400">&bull;</span>
                    <span class="text-gray-500">{{ $blog->time_read }} min read</span>
                    <span class="text-gray-400">&bull;</span>
                    <span class="text-gray-500">{{ $blog->created_at->format('d M Y') }}</span>
                </div>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors p-2 rounded-full hover:bg-gray-200"
                data-modal-toggle="view-blog-modal-{{ $blog->blog_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="overflow-y-auto p-0">
            <div class="relative h-64 w-full bg-gray-200">
                @if($blog->image_path)
                    <img src="{{ asset($blog->image_path) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
            </div>

            <div class="p-8 max-w-3xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-8 leading-tight">{{ $blog->title }}</h1>
                
                <div class="prose prose-blue prose-lg max-w-none text-gray-600">
                    {!! $blog->content !!}
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-100 bg-gray-50 flex justify-end space-x-3">
            <button type="button" data-modal-toggle="view-blog-modal-{{ $blog->blog_id }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                Close
            </button>
            <a href="#" data-modal-toggle="edit-blog-modal-{{ $blog->blog_id }}" data-modal-hide="view-blog-modal-{{ $blog->blog_id }}"
                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Edit Post
            </a>
        </div>
    </div>
</div>