@extends('web.layouts.app')

@section('title', 'Blog - New Heroes International')

@section('content')
<!-- Hero Section -->
<div class="relative bg-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                INSIGHTS & GUIDES
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Blog & News
            </h1>
            <p class="text-2xl text-gray-600 leading-relaxed">
                Industry insights, import guides, and cargo clearing tips
            </p>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white border-b border-gray-200 sticky top-0 z-10 shadow-sm">
    <div class="container mx-auto px-4 py-6">
        <form method="GET" action="{{ route('blog') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[250px]">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search articles..." 
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>
            <div>
                <select name="category" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->published_posts_count }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition hover:scale-105 font-semibold">
                <i class="fas fa-search mr-2"></i> Search
            </button>
            @if(request()->hasAny(['search', 'category']))
                <a href="{{ route('blog') }}" class="px-8 py-3 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition hover:scale-105 font-semibold">
                    <i class="fas fa-times mr-2"></i> Clear
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Blog Posts -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        @if($posts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                @foreach($posts as $post)
                    <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group">
                        <!-- Featured Image -->
                        @if($post->featured_image)
                            <div class="h-56 overflow-hidden">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                    alt="{{ $post->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                        @else
                            <div class="h-56 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-6xl opacity-80"></i>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-8">
                            <!-- Meta -->
                            <div class="flex items-center flex-wrap gap-3 text-sm text-gray-500 mb-4">
                                @if($post->category)
                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                <span class="flex items-center">
                                    <i class="far fa-calendar mr-1.5"></i> {{ $post->published_at->format('M d, Y') }}
                                </span>
                                <span class="flex items-center">
                                    <i class="far fa-eye mr-1.5"></i> {{ number_format($post->views) }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h2 class="text-2xl font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-blue-600 transition leading-tight">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>

                            <!-- Excerpt -->
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">{{ $post->excerpt }}</p>

                            <!-- Author & Read More -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                        <i class="fas fa-user text-blue-600 text-xs"></i>
                                    </div>
                                    {{ $post->author->name ?? 'Admin' }}
                                </div>
                                <a href="{{ route('blog.show', $post->slug) }}" 
                                    class="text-blue-600 font-semibold hover:text-blue-700 transition text-sm group-hover:underline">
                                    Read More <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 max-w-7xl mx-auto">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-20 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-blog text-gray-400 text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                    @if(request()->hasAny(['search', 'category']))
                        No articles found
                    @else
                        No blog posts available yet
                    @endif
                </h3>
                <p class="text-gray-600 mb-8">
                    @if(request()->hasAny(['search', 'category']))
                        Try adjusting your filters or search terms.
                    @else
                        Check back soon for industry insights and guides.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'category']))
                    <a href="{{ route('blog') }}" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition font-semibold">
                        View All Articles
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
