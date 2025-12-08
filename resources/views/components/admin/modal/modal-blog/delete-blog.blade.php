<div class="relative w-full max-w-md px-4 h-full md:h-auto slide-down">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="delete-blog-modal-{{ $blog->blog_id }}">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        
        <div class="p-8 text-center">
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
                <svg class="h-10 w-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            
            <h3 class="mb-4 text-xl font-bold text-gray-900">Delete this post?</h3>
            <p class="mb-8 text-sm text-gray-500">
                Are you sure you want to delete <span class="font-semibold text-gray-800">"{{ $blog->title }}"</span>? This action cannot be undone and will remove the post from your blog permanently.
            </p>
            
            <form action="{{ route('manage-blog.destroy', $blog->blog_id) }}" method="POST" class="flex justify-center gap-4">
                @csrf
                @method('DELETE')
                
                <button data-modal-toggle="delete-blog-modal-{{ $blog->blog_id }}" type="button" 
                    class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200">
                    Cancel
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 shadow-lg shadow-red-600/30">
                    Yes, Delete it
                </button>
            </form>
        </div>
    </div>
</div>