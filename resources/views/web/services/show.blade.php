@extends('web.layouts.app')

@section('title', $service->meta_title ?? $service->title . ' - New Heroes International')

@if($service->meta_description)
    @section('meta_description', $service->meta_description)
@endif

@section('content')
<style>
    .service-content {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #4b5563;
    }
    .service-content h2 {
        font-size: 2.25rem;
        font-weight: 700;
        color: #111827;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }
    .service-content h2:first-child {
        margin-top: 0;
    }
    .service-content h3 {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1f2937;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        line-height: 1.3;
    }
    .service-content p {
        margin-bottom: 1.5rem;
        line-height: 1.8;
    }
    .service-content ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 2rem;
    }
    .service-content ul li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 1rem;
        line-height: 1.7;
    }
    .service-content ul li::before {
        content: '→';
        position: absolute;
        left: 0;
        color: #3b82f6;
        font-weight: 600;
    }
    .sidebar-card {
        position: sticky;
        top: 100px;
        transition: all 0.3s ease;
    }
    .breadcrumb-link {
        transition: all 0.2s ease;
    }
    .breadcrumb-link:hover {
        color: #3b82f6;
    }
    .related-service-card {
        transition: all 0.3s ease;
    }
    .related-service-card:hover {
        transform: translateY(-4px);
    }
</style>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-gray-50 to-white py-16 md:py-24 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="breadcrumb-link">Home</a>
                <i class="fas fa-chevron-right mx-3 text-xs"></i>
                <a href="{{ route('services') }}" class="breadcrumb-link">Services</a>
                <i class="fas fa-chevron-right mx-3 text-xs"></i>
                <span class="text-gray-900">{{ $service->title }}</span>
            </div>
            
            <!-- Badge -->
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                PROFESSIONAL SERVICE
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $service->title }}
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-600 leading-relaxed">
                {{ $service->short_description }}
            </p>
        </div>
    </div>
</div>

<!-- Service Content -->
<div class="py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if($service->image)
                    <div class="mb-12 rounded-2xl overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" 
                            class="w-full h-auto">
                    </div>
                @endif

                <div class="service-content">
                    {!! $service->description !!}
                </div>

                <!-- Related Services -->
                @if($relatedServices->count() > 0)
                    <div class="mt-16 pt-16 border-t border-gray-200">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Services</h2>
                        <div class="grid md:grid-cols-3 gap-6">
                            @foreach($relatedServices as $related)
                                <a href="{{ route('services.show', $related->slug) }}" 
                                    class="related-service-card block bg-white rounded-xl shadow-sm hover:shadow-xl p-6 border border-gray-100">
                                    @if($related->icon)
                                        <div class="mb-4 text-blue-600 text-3xl">
                                            <i class="{{ $related->icon }}"></i>
                                        </div>
                                    @elseif($related->image)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" 
                                                class="w-16 h-16 object-contain">
                                        </div>
                                    @endif
                                    <h3 class="font-bold text-gray-900 mb-2 hover:text-blue-600 transition">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ Str::limit($related->short_description, 80) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sidebar-card space-y-6">
                    <!-- CTA Card -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-2xl p-8 shadow-xl">
                        <h3 class="text-2xl font-bold mb-4">Interested in This Service?</h3>
                        <p class="mb-6 text-blue-100 leading-relaxed">Get a customized quote tailored to your specific needs.</p>
                        <a href="{{ route('quote') }}" class="block w-full px-6 py-4 bg-white text-blue-600 text-center rounded-full font-semibold hover:bg-blue-50 transition-all hover:scale-105">
                            Request a Quote →
                        </a>
                    </div>

                    <!-- Contact Card -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Need Help?</h3>
                        <div class="space-y-4">
                            <a href="tel:+255625544404" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-3 group-hover:bg-blue-600 transition">
                                    <i class="fas fa-phone text-blue-600 group-hover:text-white text-sm"></i>
                                </div>
                                <span class="font-medium">+255 625 544 404</span>
                            </a>
                            <a href="tel:+255742058897" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-3 group-hover:bg-blue-600 transition">
                                    <i class="fas fa-phone text-blue-600 group-hover:text-white text-sm"></i>
                                </div>
                                <span class="font-medium">+255 742 058 897</span>
                            </a>
                            <a href="tel:+255776717081" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-3 group-hover:bg-blue-600 transition">
                                    <i class="fas fa-phone text-blue-600 group-hover:text-white text-sm"></i>
                                </div>
                                <span class="font-medium">+255 776 717 081</span>
                            </a>
                            <a href="mailto:info@newheroesintl.com" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-3 group-hover:bg-blue-600 transition">
                                    <i class="fas fa-envelope text-blue-600 group-hover:text-white text-sm"></i>
                                </div>
                                <span class="font-medium">info@newheroesintl.com</span>
                            </a>
                        </div>
                    </div>

                    <!-- Features Card -->
                    <div class="bg-gray-50 rounded-2xl p-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Service Features</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Professional expertise</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Fast processing</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">Full compliance</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-700">24/7 support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gray-900 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Ready to Get Started?
            </h2>
            <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                Contact us today to discuss your requirements and receive a customized solution for your business.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('quote') }}" class="inline-block px-8 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all hover:scale-105">
                    Get a Quote
                </a>
                <a href="{{ route('services') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition-all">
                    View All Services
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
