@extends('web.layouts.app')

@section('title', 'Our Services - New Heroes International')

@section('content')
<style>
    .service-card {
        position: relative;
        transition: all 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-8px);
    }
    .service-number {
        font-size: 4rem;
        font-weight: 700;
        line-height: 1;
        color: #f3f4f6;
        transition: all 0.3s ease;
    }
    .service-card:hover .service-number {
        color: #3b82f6;
    }
    .discover-link {
        position: relative;
        display: inline-block;
        overflow: hidden;
    }
    .discover-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #2563eb;
        transition: width 0.3s ease;
    }
    .discover-link:hover::after {
        width: 100%;
    }
</style>

<!-- Hero Section -->
<div class="relative bg-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                WHAT WE OFFER
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Professional Clearing & Forwarding Services
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                Comprehensive solutions for cargo clearance, logistics coordination, and import processes tailored to your business needs.
            </p>
        </div>
    </div>
</div>

<!-- Services Grid -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        @if($services->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                @foreach($services as $index => $service)
                    <div class="service-card bg-white rounded-2xl p-8 shadow-sm hover:shadow-2xl border border-gray-100">
                        <!-- Service Number -->
                        <div class="service-number mb-4">
                            {{ str_pad($service->order ?: $index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        
                        <!-- Icon (if available) -->
                        @if($service->icon)
                            <div class="mb-6 text-blue-600">
                                <i class="{{ $service->icon }} text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Service Title -->
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 leading-tight">
                            {{ $service->title }}
                        </h3>
                        
                        <!-- Description -->
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ Str::limit($service->short_description, 120) }}
                        </p>
                        
                        <!-- Discover More Link -->
                        <a href="{{ route('services.show', $service->slug) }}" 
                            class="discover-link text-gray-900 font-semibold hover:text-blue-600 transition-colors">
                            Discover More →
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($services->hasPages())
                <div class="mt-16">
                    {{ $services->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <div class="text-gray-300 text-6xl mb-6">
                    <i class="fas fa-briefcase"></i>
                </div>
                <p class="text-xl text-gray-500">No services available at the moment.</p>
            </div>
        @endif
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gray-900 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Need a Custom Solution?
            </h2>
            <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                Can't find exactly what you're looking for? Let's discuss your specific requirements and create a tailored solution.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('quote') }}" class="inline-block px-8 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all hover:scale-105">
                    Request a Quote
                </a>
                <a href="{{ route('contact') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition-all">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
