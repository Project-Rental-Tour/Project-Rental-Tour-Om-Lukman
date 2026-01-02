<div class="relative w-full max-w-4xl px-4 slide-down" x-data="{ step: 1 }">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Create New Post</h3>
                <p class="text-sm text-gray-500 mt-1">Share updates, news, or articles.</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="add-blog-modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8">
            <form id="add-blog-form" enctype="multipart/form-data" action="{{ route('manage-blog.store') }}"
                method="POST" class="space-y-8">
                @csrf

                <div class="flex justify-center mb-8">
                    <div class="flex items-center space-x-4">
                        <template x-for="i in 3" :key="i">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full font-medium transition-colors duration-300"
                                    :class="step >= i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'">
                                    <span x-text="i"></span>
                                </div>
                                <template x-if="i < 3">
                                    <div class="w-16 h-1 rounded-full transition-colors duration-300" 
                                        :class="step > i ? 'bg-blue-600' : 'bg-gray-300'"></div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="step === 1" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Article Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" placeholder="e.g., The Future of Electric Cars"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                    </div>
                    
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                            <input type="text" name="category" list="category-list" placeholder="Select or type..."
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            <datalist id="category-list">
                                <option value="Tips">
                                <option value="Destinations">
                                <option value="Culture">
                                <option value="Food">
                                <option value="News">
                            </datalist>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Time to Read (Minutes)</label>
                            <div class="relative">
                                <input type="number" name="time_read" min="1" placeholder="5"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">min</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="step === 2" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Content <span class="text-red-500">*</span></label>
                        <input id="blog-content-add" type="hidden" name="content">
                        <trix-editor input="blog-content-add" 
                            class="trix-content border border-gray-300 rounded-lg bg-white min-h-[300px] prose max-w-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></trix-editor>
                        <p class="text-xs text-gray-400 mt-2">Write your article here. You can add formatting and lists.</p>
                    </div>
                </div>

                <div x-show="step === 3" class="space-y-8" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4">
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <div class="flex-shrink-0">
                                <div class="w-64 h-40 border-2 border-dashed border-blue-300 rounded-xl flex items-center justify-center overflow-hidden bg-white relative group">
                                    <img id="preview-blog-add" src="" alt="Preview"
                                        class="w-full h-full object-cover opacity-0 transition-opacity duration-300 absolute inset-0 z-10" />
                                    
                                    <div id="placeholder-blog-add" class="flex flex-col items-center justify-center text-blue-400 transition-opacity duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs font-medium">Upload Cover</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-1 w-full space-y-4 text-center md:text-left">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-800">Cover Image</h4>
                                    <p class="text-sm text-gray-500">This image will appear at the top of your blog post and in search results.</p>
                                </div>
                                
                                <label class="inline-block">
                                    <span class="sr-only">Choose file</span>
                                    <input type="file" name="image_path" accept="image/*" required
                                        data-preview="preview-blog-add"
                                        class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2.5 file:px-6
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-600 file:text-white
                                        hover:file:bg-blue-700
                                        cursor-pointer focus:outline-none"
                                    />
                                </label>
                                <p class="text-xs text-gray-400">Recommended: 1200x630px, Max 2MB (JPG/PNG)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between pt-6 border-t border-gray-100">
                    <button type="button" @click="step = Math.max(step - 1, 1)" x-show="step > 1"
                        class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Back
                    </button>

                    <div class="ml-auto">
                        <button type="button" @click="step = step + 1" x-show="step < 3"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">
                            Next Step
                        </button>

                        <button type="submit" x-show="step === 3"
                            class="px-8 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 shadow-lg shadow-green-600/30 transition-all transform hover:-translate-y-0.5">
                            Publish Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>