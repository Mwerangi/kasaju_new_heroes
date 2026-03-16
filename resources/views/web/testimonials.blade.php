@extends('web.layouts.app')

@section('title', 'Testimonials - New Heroes International')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Client Testimonials</h1>
        <p class="text-xl text-blue-100">See What Our Clients Say About Us</p>
    </div>
</div>

<!-- Testimonials Grid -->
<div class="py-16">
    <div class="container mx-auto px-4">
        @if($testimonials->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white rounded-lg shadow-md p-8 hover:shadow-xl transition">
                        <!-- Rating Stars -->
                        <div class="flex items-center text-yellow-400 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>

                        <!-- Feedback -->
                        <p class="text-gray-700 mb-6 italic leading-relaxed">
                            "{{ $testimonial->feedback }}"
                        </p>

                        <!-- Client Info -->
                        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                            @if($testimonial->client_image)
                                <img src="{{ asset('storage/' . $testimonial->client_image) }}" 
                                    alt="{{ $testimonial->client_name }}" 
                                    class="w-14 h-14 rounded-full object-cover">
                            @else
                                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-xl"></i>
                                </div>
                            @endif

                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $testimonial->client_name }}</h4>
                                <p class="text-sm text-gray-600">
                                    {{ $testimonial->client_position }}
                                    @if($testimonial->client_company)
                                        <br>{{ $testimonial->client_company }}
                                    @endif
                                </p>
                            </div>

                            @if($testimonial->company_logo)
                                <div class="ml-auto">
                                    <img src="{{ asset('storage/' . $testimonial->company_logo) }}" 
                                        alt="Company logo" 
                                        class="h-10 w-auto object-contain opacity-70">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $testimonials->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <i class="fas fa-quote-right text-gray-300 text-6xl mb-4"></i>
                <p class="text-xl text-gray-500">No testimonials available yet.</p>
            </div>
        @endif
    </div>
</div>

<!-- CTA Section -->
<div class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Become Our Next Success Story</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Join hundreds of satisfied clients who trust us with their clearing and forwarding needs.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('quote') }}" class="px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                Request a Quote
            </a>
            <a href="{{ route('services.index') }}" class="px-8 py-3 bg-blue-700 text-white rounded-lg font-semibold hover:bg-blue-800 transition border-2 border-white">
                View Our Services
            </a>
        </div>
    </div>
</div>
@endsection
