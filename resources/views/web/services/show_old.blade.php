@extends('web.layouts.app')

@section('title', $service->meta_title ?? $service->title . ' - New Heroes International')

@if($service->meta_description)
    @section('meta_description', $service->meta_description)
@endif

@section('content')
<style>
    .service-content h2 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .service-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #374151;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .service-content p {
        margin-bottom: 1rem;
        line-height: 1.75;
    }
    .service-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .service-content ul li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }
</style>

<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl">
            <div class="flex items-center text-blue-200 text-sm mb-4">
                <a href="{{ route('services.index') }}" class="hover:text-white">Services</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span>{{ $service->title }}</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $service->title }}</h1>
            <p class="text-xl text-blue-100">{{ $service->short_description }}</p>
        </div>
    </div>
</div>

<!-- Service Content -->
<div class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if($service->image)
                    <div class="mb-8">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" 
                            class="w-full rounded-lg shadow-lg">
                    </div>
                @endif

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed service-content">
                    {!! $service->description !!}
                </div>

                <!-- Related Services -->
                @if($relatedServices->count() > 0)
                    <div class="mt-12 pt-12 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Services</h2>
                        <div class="grid md:grid-cols-3 gap-6">
                            @foreach($relatedServices as $related)
                                <a href="{{ route('services.show', $related->slug) }}" 
                                    class="block bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition group">
                                    @if($related->icon)
                                        <div class="mb-4 text-blue-600 text-4xl">
                                            <i class="{{ $related->icon }}"></i>
                                        </div>
                                    @elseif($related->image)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" 
                                                class="w-16 h-16 object-contain">
                                        </div>
                                    @endif
                                    <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-sm text-gray-600">{{ Str::limit($related->short_description, 80) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <!-- CTA Card -->
                    <div class="bg-blue-600 text-white rounded-lg p-6 shadow-lg">
                        <h3 class="text-2xl font-bold mb-3">Interested in This Service?</h3>
                        <p class="mb-6 text-blue-100">Get a customized quote for your specific needs.</p>
                        <a href="{{ route('quote') }}" class="block w-full px-6 py-3 bg-white text-blue-600 text-center rounded-lg font-semibold hover:bg-blue-50 transition">
                            Request a Quote
                        </a>
                    </div>

                    <!-- Contact Card -->
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Need Help?</h3>
                        <div class="space-y-3 text-sm">
                            <a href="tel:+255625544404" class="flex items-center text-gray-700 hover:text-blue-600 transition">
                                <i class="fas fa-phone w-8 text-blue-600"></i>
                                <span>+255 625 544 404</span>
                            </a>
                            <a href="tel:+255742058897" class="flex items-center text-gray-700 hover:text-blue-600 transition">
                                <i class="fas fa-phone w-8 text-blue-600"></i>
                                <span>+255 742 058 897</span>
                            </a>
                            <a href="tel:+255776717081" class="flex items-center text-gray-700 hover:text-blue-600 transition">
                                <i class="fas fa-phone w-8 text-blue-600"></i>
                                <span>+255 776 717 081</span>
                            </a>
                            <a href="mailto:info@newheroesintl.com" class="flex items-center text-gray-700 hover:text-blue-600 transition">
                                <i class="fas fa-envelope w-8 text-blue-600"></i>
                                <span>info@newheroesintl.com</span>
                            </a>
                        </div>
                    </div>

                    <!-- All Services Link -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <a href="{{ route('services.index') }}" class="flex items-center justify-between text-blue-600 hover:text-blue-700 font-semibold">
                            <span>View All Services</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
