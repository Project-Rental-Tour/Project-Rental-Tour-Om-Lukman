<div class="relative w-full max-w-4xl px-4 slide-down" x-data="{ step: 1 }">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Post</h3>
                <p class="text-sm text-gray-500 mt-1">Editing: <span class="font-medium text-blue-600">{{ Str::limit($blog->title, 30) }}</span></p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="edit-blog-modal-{{ $blog->blog_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8">
            <form action="{{ route('manage-blog.update', $blog->blog_id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="flex justify-center mb-8">
                    <div class="flex items-center space-x-4">
                        <template x-for="i in 3" :key="i">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full font-medium transition-colors duration-300"
                                    :class="step >= i ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-500'">
                                    <span x-text="i"></span>
                                </div>
                                <template x-if="i < 3">
                                    <div class="w-16 h-1 rounded-full transition-colors duration-300" 
                                        :class="step > i ? 'bg-yellow-500' : 'bg-gray-300'"></div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="step === 1" class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Article Title</label>
                        <input type="text" name="title" value="{{ $blog->title }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                    
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                            <input type="text" name="category" value="{{ $blog->category }}" list="category-list"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Time to Read</label>
                            <input type="number" name="time_read" value="{{ $blog->time_read }}" min="1"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" required>
                        </div>
                    </div>
                </div>

                <div x-show="step === 2" class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Content</label>
                        <input id="blog-content-edit-{{ $blog->blog_id }}" type="hidden" name="content" value="{{ $blog->content }}">
                        <trix-editor input="blog-content-edit-{{ $blog->blog_id }}" 
                            class="trix-content border border-gray-300 rounded-lg bg-white min-h-[300px] prose max-w-none"></trix-editor>
                    </div>
                </div>

                <div x-show="step === 3" class="space-y-8">
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <div class="flex-shrink-0">
                                <div class="w-64 h-40 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center overflow-hidden bg-white relative">
                                    <img id="preview-blog-edit-{{ $blog->blog_id }}" 
                                        src="{{ $blog->image ? asset($blog->image) : '' }}" 
                                        class="w-full h-full object-cover {{ $blog->image ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-300 absolute inset-0 z-10" />
                                    
                                    <div id="placeholder-blog-edit-{{ $blog->blog_id }}" class="flex flex-col items-center justify-center text-gray-400 {{ $blog->image ? 'hidden' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs">Current / New Image</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 w-full space-y-4 text-center md:text-left">
                                <label class="block text-sm font-medium text-gray-700">Change Cover Image</label>
                                <input type="file" name="image" accept="image/*"
                                    data-preview="preview-blog-edit-{{ $blog->blog_id }}"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-white hover:file:bg-yellow-600 cursor-pointer" />
                                <p class="text-xs text-gray-400">Leave empty to keep current image.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between pt-6 border-t border-gray-100">
                    <button type="button" @click="step = Math.max(step - 1, 1)" x-show="step > 1"
                        class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Back
                    </button>
                    <div class="ml-auto">
                        <button type="button" @click="step = step + 1" x-show="step < 3"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 shadow-sm">
                            Next Step
                        </button>
                        <button type="submit" x-show="step === 3"
                            class="px-8 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 shadow-lg shadow-green-600/30">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>