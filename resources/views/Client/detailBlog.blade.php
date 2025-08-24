@extends('_layouts.user')

@section('head')
@endsection

@section('content')
    @include('components.client.navbar')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm text-gray-600">
            <a href="#" class="hover:text-blue-600 transition">Home</a>
            <span class="mx-2">/</span>
            <a href="#" class="hover:text-blue-600 transition">Articles</a>
            <span class="mx-2">/</span>
            <span class="text-gray-400">The Future of Web Development in 2023</span>
        </nav>

        <!-- Article Header -->
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                The Future of Web Development in 2023: Trends and Predictions
            </h1>

            <!-- Featured Image with Category Badge -->
            <div class="relative rounded-xl overflow-hidden shadow-lg mb-6">
                <img src="https://images.unsplash.com/photo-1581276879432-15e50529f34b?auto=format&fit=crop&w=1470&q=80"
                    alt="Web Development" class="w-full h-96 object-cover">

                <!-- Category Badge -->
                <span
                    class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-semibold px-4 py-1 rounded-full shadow">
                    Tech
                </span>
            </div>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                <!-- Author -->
                <div class="flex items-center">
                    <img src="https://i.pravatar.cc/30?img=5" alt="Author" class="w-6 h-6 rounded-full mr-2">
                    <span>By John Doe</span>
                </div>
                <!-- Posted Date -->
                <div class="flex items-center">
                    <i class="far fa-calendar-alt mr-2 text-blue-600"></i>
                    <span>Posted on August 24, 2023</span>
                </div>
                <!-- Reading Time -->
                <div class="flex items-center">
                    <i class="far fa-clock mr-2 text-blue-600"></i>
                    <span>10 min read</span>
                </div>
            </div>


            <!-- Share Buttons -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Share this article:</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="#"
                        class="share-btn bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </a>
                    <a href="#"
                        class="share-btn bg-blue-400 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                        <i class="fab fa-twitter mr-2"></i> Twitter
                    </a>
                    <a href="#"
                        class="share-btn bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                        <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                    </a>
                    <a href="#"
                        class="share-btn bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                        <i class="fab fa-pinterest-p mr-2"></i> Pinterest
                    </a>
                    <a href="#"
                        class="share-btn bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                        <i class="fas fa-link mr-2"></i> Copy Link
                    </a>
                </div>
            </div>
        </header>

        <!-- Article Content -->
        <article class="article-content mb-12 text-gray-700">
            <p class="text-lg font-medium text-gray-800">Web development continues to evolve rapidly, and 2023 brings
                exciting new trends and technologies that are shaping the future of how we build for the web. From
                AI-assisted development to the rise of Web3, developers have more tools and possibilities than ever before.
            </p>

            <h2>AI and Machine Learning Integration</h2>
            <p>One of the most significant trends in web development is the integration of artificial intelligence and
                machine learning. AI-powered tools are now assisting developers in writing code, debugging, and even
                generating entire components.</p>

            <p>Platforms like GitHub Copilot and Amazon CodeWhisperer are changing how developers work by providing
                intelligent code suggestions and autocompletion. This not only speeds up development but also helps reduce
                errors and improves code quality.</p>

            <h2>The Rise of Web3 and Blockchain</h2>
            <p>Web3 technologies are gaining traction, with blockchain-based applications becoming more mainstream.
                Developers are exploring decentralized applications (dApps) that offer increased security, transparency, and
                user control over data.</p>

            <p>While still in its early stages, Web3 represents a paradigm shift in how we think about web architecture and
                data ownership. Smart contracts, NFTs, and decentralized storage solutions are becoming essential skills for
                forward-thinking developers.</p>

            <h2>Performance and Core Web Vitals</h2>
            <p>Google's Core Web Vitals continue to be a crucial ranking factor, pushing developers to prioritize
                performance optimization. Techniques like code splitting, lazy loading, and efficient caching strategies are
                more important than ever.</p>

            <p>New frameworks and tools are emerging that focus on delivering exceptional performance out of the box, with
                solutions like Next.js, Remix, and Astro gaining popularity for their focus on speed and user experience.
            </p>

            <h2>Serverless Architecture and Edge Computing</h2>
            <p>Serverless computing is maturing, with more companies adopting Function-as-a-Service (FaaS) models. This
                approach allows developers to focus on writing code without worrying about infrastructure management.</p>

            <p>Edge computing is also becoming more prevalent, with content delivery networks (CDNs) offering compute
                capabilities at the edge. This reduces latency and improves performance for users around the globe.</p>

            <p>As we look to the future, it's clear that web development will continue to evolve at a rapid pace. Developers
                who stay curious, continuously learn, and adapt to new technologies will be well-positioned to thrive in
                this dynamic landscape.</p>
        </article>



        <!-- Share Section Bottom -->
        <div class="bg-blue-50 rounded-xl p-6 mb-12 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Enjoyed this article?</h3>
            <p class="text-gray-600 mb-4">Share it with your network to help others discover it too!</p>
            <div class="flex justify-center gap-3">
                <a href="#"
                    class="share-btn bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fab fa-facebook-f mr-2"></i> Share
                </a>
                <a href="#"
                    class="share-btn bg-blue-400 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fab fa-twitter mr-2"></i> Tweet
                </a>
                <a href="#"
                    class="share-btn bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fab fa-linkedin-in mr-2"></i> Share
                </a>
            </div>
        </div>

        <!-- Related Articles -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative overflow-hidden h-48">
                        <div class="blog-image absolute inset-0 bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-utensils text-4xl text-yellow-600"></i>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-white text-yellow-600 text-xs font-semibold px-3 py-1 rounded-full">Culture</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="far fa-calendar mr-2"></i>
                            <span>June 5, 2023</span>
                            <i class="far fa-clock ml-4 mr-2"></i>
                            <span>4 min read</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">A Culinary Journey Through Southeast Asia</h3>
                        <p class="text-gray-600 mb-5">Explore the diverse and flavorful cuisine of Southeast Asia, from
                            street food to fine dining.</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <span class="text-sm font-medium">Lisa Chen</span>
                            </div>
                            <a href="#" class="text-blue-600 font-semibold text-sm flex items-center">
                                Read More
                                <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative overflow-hidden h-48">
                        <div class="blog-image absolute inset-0 bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-code text-4xl text-blue-600"></i>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-white text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Tech</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="far fa-calendar mr-2"></i>
                            <span>July 12, 2023</span>
                            <i class="far fa-clock ml-4 mr-2"></i>
                            <span>6 min read</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Top 10 JavaScript Frameworks in 2023</h3>
                        <p class="text-gray-600 mb-5">Discover which JavaScript frameworks are leading the industry this
                            year.</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <span class="text-sm font-medium">Michael Lee</span>
                            </div>
                            <a href="#" class="text-blue-600 font-semibold text-sm flex items-center">
                                Read More
                                <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('components.client.footer')
@endsection