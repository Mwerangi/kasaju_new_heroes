@extends('web.layouts.app')

@section('title', 'Our Process - New Heroes International')

@section('content')
<style>
    .process-step-card {
        transition: all 0.3s ease;
    }
    .process-step-card:hover {
        transform: translateY(-4px);
    }
    .step-number-large {
        font-size: 6rem;
        font-weight: 700;
        line-height: 1;
        color: #f3f4f6;
        transition: all 0.3s ease;
    }
    .process-step-card:hover .step-number-large {
        color: #3b82f6;
    }
    .timeline-line {
        position: absolute;
        left: 2rem;
        top: 5rem;
        bottom: -3rem;
        width: 2px;
        background: linear-gradient(to bottom, #3b82f6, #93c5fd);
    }
    .timeline-dot {
        position: relative;
        z-index: 10;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        background: white;
        border: 4px solid #3b82f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.25rem;
        color: #3b82f6;
        transition: all 0.3s ease;
    }
    .process-step-card:hover .timeline-dot {
        background: #3b82f6;
        color: white;
        transform: scale(1.1);
    }
</style>

<!-- Hero Section -->
<div class="relative bg-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                HOW IT WORKS
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Our Clearance Process
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                A streamlined, transparent process designed to get your cargo cleared efficiently and hassle-free.
            </p>
        </div>
    </div>
</div>

<!-- Process Steps -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        @if($steps->count() > 0)
            <div class="max-w-6xl mx-auto">
                <!-- Steps Grid -->
                <div class="space-y-16">
                    @foreach($steps as $index => $step)
                        <div class="process-step-card relative">
                            <!-- Timeline Line (for all except last) -->
                            @if(!$loop->last)
                                <div class="timeline-line hidden md:block"></div>
                            @endif
                            
                            <div class="grid md:grid-cols-12 gap-8 items-start">
                                <!-- Left: Number & Dot -->
                                <div class="md:col-span-2 flex flex-col items-center md:items-start">
                                    <div class="timeline-dot mb-4">
                                        {{ str_pad($step->step_number, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </div>
                                
                                <!-- Right: Content Card -->
                                <div class="md:col-span-10">
                                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl border border-gray-100 transition-all">
                                        <!-- Large Step Number in Background -->
                                        <div class="step-number-large absolute top-4 right-8 pointer-events-none">
                                            {{ str_pad($step->step_number, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                        
                                        <div class="relative z-10">
                                            <!-- Icon (if available) -->
                                            @if($step->icon)
                                                <div class="mb-4 text-blue-600">
                                                    <i class="{{ $step->icon }} text-4xl"></i>
                                                </div>
                                            @endif
                                            
                                            <!-- Title -->
                                            <h3 class="text-3xl font-bold text-gray-900 mb-4 leading-tight">
                                                {{ $step->title }}
                                            </h3>
                                            
                                            <!-- Description -->
                                            <p class="text-gray-600 text-lg leading-relaxed mb-4">
                                                {{ $step->description }}
                                            </p>
                                            
                                            <!-- Step Counter -->
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-layer-group text-blue-600 mr-2"></i>
                                                <span>Step {{ $step->step_number }} of {{ $steps->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Why Choose Our Process Section -->
            <div class="max-w-6xl mx-auto mt-20">
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-3xl p-12 border border-blue-100">
                    <div class="text-center mb-10">
                        <div class="inline-block px-4 py-1.5 bg-blue-600 text-white text-sm font-semibold rounded-full mb-4">
                            WHY CHOOSE US
                        </div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">
                            Why Choose Our Process?
                        </h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Experience the difference of working with clearance experts who prioritize your success.
                        </p>
                    </div>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Transparent Process</h4>
                            <p class="text-sm text-gray-600">Clear visibility at every step of the clearance journey.</p>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-comments text-blue-600 text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Regular Updates</h4>
                            <p class="text-sm text-gray-600">Stay informed with timely communication throughout.</p>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-file-contract text-purple-600 text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Expert Documentation</h4>
                            <p class="text-sm text-gray-600">Professional handling of all paperwork and compliance.</p>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-shield-alt text-orange-600 text-xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Full Compliance</h4>
                            <p class="text-sm text-gray-600">100% adherence to customs regulations and standards.</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-gray-300 text-6xl mb-6">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Process Steps Coming Soon</h3>
                <p class="text-lg text-gray-500">We're preparing detailed information about our clearance process.</p>
            </div>
        @endif
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
                Let us handle your clearance process from start to finish. Get in touch today and experience hassle-free cargo clearance!
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('quote') }}" class="inline-block px-8 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all hover:scale-105">
                    Request a Quote
                </a>
                <a href="{{ route('services') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition-all">
                    Our Services
                </a>
                <a href="{{ route('contact') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition-all">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
