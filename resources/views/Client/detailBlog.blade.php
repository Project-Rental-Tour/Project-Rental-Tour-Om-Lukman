@extends('_layouts.user')

@section('head')
    <style>
        .bg-primary {
            background-color: #799eff;
        }

        .text-primary {
            color: #799eff;
        }
    </style>
@endsection

@section('content')
    @include('components.client.navbar')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm text-gray-600">
            <a href="{{ route('index') }}" class="hover:text-blue-600 transition">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('index') }}" class="hover:text-blue-600 transition">Articles</a>
            <span class="mx-2">/</span>
            <span class="text-gray-400">{{ $blog->title }}</span>
        </nav>

        <!-- Article Header -->
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $blog->title }}
            </h1>

            <!-- Featured Image with Category Badge -->
            <div class="relative rounded-xl overflow-hidden shadow-lg mb-6">
                @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}"
                        class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                    </div>
                @endif

                <!-- Category Badge -->
                <span
                    class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-semibold px-4 py-1 rounded-full shadow">
                    {{ $blog->type }}
                </span>
            </div>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                <!-- Author -->
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    {{-- <span>By {{ $blog->author }}</span> --}}
                    <span>By SEPTEM TOUR</span>
                </div>
                <!-- Posted Date -->
                <div class="flex items-center">
                    <i class="far fa-calendar-alt mr-2 text-blue-600"></i>
                    <span>Posted on {{ $blog->created_at->format('F j, Y') }}</span>
                </div>
                <!-- Reading Time -->
                <div class="flex items-center">
                    <i class="far fa-clock mr-2 text-blue-600"></i>
                    <span>{{ $blog->reading_time }} min read</span>
                </div>
            </div>

        </header>

        <!-- Article Content -->
        <article class="article-content mb-12 text-gray-700 leading-relaxed">
            {!! $blog->content !!}
        </article>

        <!-- Share Section Bottom -->
        <div class="bg-blue-50 rounded-xl p-6 mb-12 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Enjoyed this article?</h3>
            <p class="text-gray-600 mb-4">Share it with your network to help others discover it too!</p>
            <div class="flex justify-center gap-3">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.detail-blog', $blog->slug)) }}"
                    target="_blank"
                    class="share-btn bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fab fa-facebook-f mr-2"></i> Share
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.detail-blog', $blog->slug)) }}&text={{ urlencode($blog->title) }}"
                    target="_blank"
                    class="share-btn bg-blue-400 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fab fa-twitter mr-2"></i> Tweet
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.detail-blog', $blog->slug)) }}&title={{ urlencode($blog->title) }}"
                    target="_blank"
                    class="share-btn bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fab fa-linkedin-in mr-2"></i> Share
                </a>
                <button onclick="copyLink()"
                    class="share-btn bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fas fa-link mr-2"></i> Copy Link
                </button>
            </div>
        </div>

        <!-- Related Articles -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h3>
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($relatedBlogs as $related)
                    <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="relative overflow-hidden h-48">
                            @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="bg-white text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $related->type }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-gray-500 text-sm mb-4">
                                <i class="far fa-calendar mr-2"></i>
                                <span>{{ $related->created_at->format('M j, Y') }}</span>
                                <i class="far fa-clock ml-4 mr-2"></i>
                                <span>{{ $related->reading_time }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $related->title }}</h3>
                            <p class="text-gray-600 mb-5 line-clamp-3">{!! Str::limit(strip_tags($related->content), 100) !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                    {{-- <span class="text-sm font-medium">{{ $related->author }}</span> --}}
                                    <span class="text-sm font-medium">SEPTEM TOUR</span>
                                </div>
                                <a href="{{ route('blog.detail-blog', $related->slug) }}"
                                    class="text-primary font-semibold text-sm flex items-center hover:underline">
                                    Read More
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-2">No related articles available.</p>
                @endforelse
            </div>
        </div>
    </div>

    @include('components.client.footer')

    @push('scripts')
        <script>
            function copyLink() {
                const url = "{{ route('blog.detail-blog', $blog->slug) }}";
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link copied to clipboard!');
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                });
            }
        </script>
    @endpush
@endsection