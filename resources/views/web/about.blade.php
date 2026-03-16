@extends('web.layouts.app')

@section('title', $page && $page->meta_title ? $page->meta_title : 'About Us - New Heroes International')

@section('content')
<style>
    .value-card {
        transition: all 0.3s ease;
    }
    .value-card:hover {
        transform: translateY(-8px);
    }
    .value-card-icon {
        transition: all 0.3s ease;
    }
    .value-card:hover .value-card-icon {
        transform: scale(1.1) rotate(5deg);
    }
    .stats-number {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1;
    }
</style>

@php
    $hero = $page ? $page->sections->where('section_key', 'hero')->first() : null;
@endphp

<!-- Hero Section -->
<div class="relative bg-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                WHO WE ARE
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $hero && $hero->title ? $hero->title : 'NEW HEROES INTERNATIONAL LIMITED' }}
            </h1>
            <p class="text-2xl text-gray-600 leading-relaxed mb-8">
                {{ $hero && $hero->subtitle ? $hero->subtitle : 'Your Trusted Partner in Cargo Clearing and Logistics' }}
            </p>
            @if($hero && $hero->content)
            <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
                {{ $hero->content }}
            </p>
            @endif
        </div>
    </div>
</div>

@php
    $overview = $page ? $page->sections->where('section_key', 'overview')->first() : null;
@endphp

<!-- Company Overview -->
@if($overview)
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            @if($overview->title)
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ $overview->title }}
                </h2>
            </div>
            @endif
            
            @if($overview->content)
            <div class="prose prose-lg max-w-none text-gray-600 text-lg leading-relaxed space-y-6">
                {!! $overview->content !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endif

@php
    $mission = $page ? $page->sections->where('section_key', 'mission')->first() : null;
    $vision = $page ? $page->sections->where('section_key', 'vision')->first() : null;
@endphp

<!-- Mission & Vision -->
@if($mission || $vision)
<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Mission -->
                @if($mission)
                <div class="bg-white rounded-3xl p-10 shadow-sm hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $mission->title }}</h3>
                    <div class="text-gray-600 text-lg leading-relaxed prose prose-lg max-w-none">
                        {!! $mission->content !!}
                    </div>
                </div>
                @endif
                
                <!-- Vision -->
                @if($vision)
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl p-10 text-white shadow-xl">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-white text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold mb-4">{{ $vision->title }}</h3>
                    <div class="text-blue-100 text-lg leading-relaxed prose prose-lg max-w-none">
                        {!! $vision->content !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@php
    $values = $page ? $page->sections->where('section_key', 'values')->first() : null;
@endphp

<!-- Core Values -->
@if($values)
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-4">
                    OUR PRINCIPLES
                </div>
                @if($values->title)
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ $values->title }}
                </h2>
                @endif
                @if($values->subtitle)
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    {{ $values->subtitle }}
                </p>
                @endif
            </div>
            
            @if($values->additional_data && is_array($values->additional_data))
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($values->additional_data as $value)
                <div class="value-card bg-white rounded-2xl p-8 shadow-sm hover:shadow-2xl border border-gray-100">
                    <div class="value-card-icon w-16 h-16 bg-{{ $value['color'] ?? 'blue' }}-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas {{ $value['icon'] ?? 'fa-star' }} text-{{ $value['color'] ?? 'blue' }}-600 text-3xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">{{ $value['title'] }}</h4>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $value['description'] }}
                    </p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endif

@php
    $services = $page ? $page->sections->where('section_key', 'services')->first() : null;
@endphp

<!-- What We Do -->
@if($services)
<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-4">
                    OUR EXPERTISE
                </div>
                @if($services->title)
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ $services->title }}
                </h2>
                @endif
                @if($services->subtitle)
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ $services->subtitle }}
                </p>
                @endif
            </div>
            
            @if($services->additional_data && is_array($services->additional_data))
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services->additional_data as $service)
                <div class="bg-white rounded-xl p-6 hover:shadow-lg transition border border-gray-100">
                    <div class="flex items-start">
                        <i class="fas {{ $service['icon'] ?? 'fa-check' }} text-blue-600 text-2xl mr-4 mt-1"></i>
                        <div>
                            <h5 class="font-bold text-gray-900 mb-2">{{ $service['title'] }}</h5>
                            <p class="text-sm text-gray-600">{{ $service['description'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endif

@php
    $whyChoose = $page ? $page->sections->where('section_key', 'why_choose')->first() : null;
@endphp

<!-- Why Choose Us -->
@if($whyChoose)
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            @if($whyChoose->title)
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ $whyChoose->title }}
                </h2>
            </div>
            @endif
            
            @if($whyChoose->additional_data && is_array($whyChoose->additional_data))
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($whyChoose->additional_data as $reason)
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-{{ $reason['color'] ?? 'blue' }}-100 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas {{ $reason['icon'] ?? 'fa-check' }} text-{{ $reason['color'] ?? 'blue' }}-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $reason['title'] }}</h4>
                        <p class="text-gray-600">{{ $reason['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endif

@php
    $industries = $page ? $page->sections->where('section_key', 'industries')->first() : null;
@endphp

<!-- Industries We Serve -->
@if($industries)
<div class="py-20 bg-gradient-to-br from-blue-50 to-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                @if($industries->title)
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ $industries->title }}
                </h2>
                @endif
                @if($industries->subtitle)
                <p class="text-xl text-gray-600">
                    {{ $industries->subtitle }}
                </p>
                @endif
            </div>
            
            @if($industries->additional_data && is_array($industries->additional_data))
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($industries->additional_data as $industry)
                <div class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition">
                    <i class="fas {{ $industry['icon'] ?? 'fa-briefcase' }} text-{{ $industry['color'] ?? 'blue' }}-600 text-3xl mb-3"></i>
                    <p class="text-sm font-semibold text-gray-900">{{ $industry['title'] }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endif

@php
    $commitment = $page ? $page->sections->where('section_key', 'commitment')->first() : null;
@endphp

<!-- Our Commitment -->
@if($commitment)
<div class="py-20 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            @if($commitment->title)
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                {{ $commitment->title }}
            </h2>
            @endif
            @if($commitment->content)
            <div class="text-xl text-gray-300 leading-relaxed mb-10 prose prose-lg prose-invert max-w-none">
                {!! $commitment->content !!}
            </div>
            @endif
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('services') }}" class="inline-block px-8 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all hover:scale-105">
                    Our Services
                </a>
                <a href="{{ route('quote') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition-all">
                    Request a Quote
                </a>
                <a href="{{ route('contact') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition-all">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
