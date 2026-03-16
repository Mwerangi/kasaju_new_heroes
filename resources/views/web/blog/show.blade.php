@extends('web.layouts.app')

@section('title', $post->meta_title ?? $post->title . ' - New Heroes International')

@if($post->meta_description)
    @section('meta_description', $post->meta_description)
@endif

@section('content')
<style>
    .article-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin-top: 2.5rem;
        margin-bottom: 1.5rem;
    }
    .article-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #374151;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .article-content h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #4b5563;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .article-content p {
        margin-bottom: 1.5rem;
        line-height: 1.8;
    }
    .article-content ul {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    .article-content ul li {
        margin-bottom: 0.75rem;
        position: relative;
        padding-left: 1.5rem;
    }
    .article-content ul li:before {
        content: '→';
        position: absolute;
        left: 0;
        color: #2563eb;
        font-weight: 700;
    }
    .article-content strong {
        color: #1f2937;
        font-weight: 600;
    }
</style>

<!-- Hero Section -->
<div class="relative bg-white py-16 md:py-24 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('blog') }}" class="hover:text-blue-600 transition">
                    <i class="fas fa-home mr-2"></i>Blog
                </a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                @if($post->category)
                    <a href="{{ route('blog', ['category' => $post->category->id]) }}" class="hover:text-blue-600 transition">
                        {{ $post->category->name }}
                    </a>
                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                @endif
                <span class="text-gray-900">Article</span>
            </div>

            <!-- Category Badge -->
            @if($post->category)
                <div class="mb-6">
                    <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full">
                        {{ $post->category->name }}
                    </span>
                </div>
            @endif

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-8 leading-tight">
                {{ $post->title }}
            </h1>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-6 text-gray-600">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <span class="font-medium">{{ $post->author->name ?? 'Admin' }}</span>
                </div>
                <div class="flex items-center">
                    <i class="far fa-calendar mr-2 text-blue-600"></i>
                    <span>{{ $post->published_at->format('F d, Y') }}</span>
                </div>
                <div class="flex items-center">
                    <i class="far fa-clock mr-2 text-blue-600"></i>
                    <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                </div>
                <div class="flex items-center">
                    <i class="far fa-eye mr-2 text-blue-600"></i>
                    <span>{{ number_format($post->views) }} views</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Article Content -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="mb-12">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                        alt="{{ $post->title }}" 
                        class="w-full rounded-3xl shadow-2xl">
                </div>
            @endif

            <!-- Excerpt -->
            @if($post->excerpt)
                <div class="mb-12 p-8 bg-blue-50 rounded-2xl border-l-4 border-blue-600">
                    <p class="text-xl text-gray-700 leading-relaxed italic">
                        {{ $post->excerpt }}
                    </p>
                </div>
            @endif

            <!-- Article Body -->
            <div class="article-content text-gray-700 text-lg leading-relaxed">
                {!! $post->content !!}
            </div>

            <!-- Share Buttons -->
            <div class="mt-16 pt-12 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Share This Article</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" 
                        target="_blank" rel="noopener"
                        class="px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 hover:scale-105 transition font-semibold">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                        target="_blank" rel="noopener"
                        class="px-6 py-3 bg-sky-500 text-white rounded-full hover:bg-sky-600 hover:scale-105 transition font-semibold">
                        <i class="fab fa-twitter mr-2"></i> Twitter
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}" 
                        target="_blank" rel="noopener"
                        class="px-6 py-3 bg-blue-700 text-white rounded-full hover:bg-blue-800 hover:scale-105 transition font-semibold">
                        <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                    </a>
                    <button onclick="copyLink()" 
                        class="px-6 py-3 bg-gray-600 text-white rounded-full hover:bg-gray-700 hover:scale-105 transition font-semibold">
                        <i class="fas fa-link mr-2"></i> Copy Link
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-4">
                        RELATED CONTENT
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900">More Articles You Might Like</h2>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $related)
                        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group">
                            @if($related->featured_image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                        alt="{{ $related->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-5xl opacity-80"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                                    <i class="far fa-calendar"></i>
                                    {{ $related->published_at->format('M d, Y') }}
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition leading-tight">
                                    <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4 leading-relaxed">{{ $related->excerpt }}</p>
                                <a href="{{ route('blog.show', $related->slug) }}" 
                                    class="text-blue-600 font-semibold hover:text-blue-700 transition text-sm group-hover:underline">
                                    Read Article <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

<!-- CTA Section -->
<div class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <div class="inline-block px-4 py-1.5 bg-white/10 text-white text-sm font-semibold rounded-full mb-6">
                GET STARTED
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Need Clearing & Forwarding Services?</h2>
            <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                Let us handle your logistics needs professionally and efficiently
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('quote') }}" class="px-10 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 hover:scale-105 transition">
                    Request a Quote
                </a>
                <a href="{{ route('services') }}" class="px-10 py-4 bg-white/10 text-white rounded-full font-semibold hover:bg-white/20 hover:scale-105 transition">
                    Our Services
                </a>
                <a href="{{ route('contact') }}" class="px-10 py-4 bg-white/10 text-white rounded-full font-semibold hover:bg-white/20 hover:scale-105 transition">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copied to clipboard!');
    }).catch(() => {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Link copied to clipboard!');
    });
}
</script>
@endpush
@endsection
