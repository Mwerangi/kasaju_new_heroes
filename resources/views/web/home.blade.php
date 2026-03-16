@extends('web.layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-32 md:py-48 min-h-[600px] md:min-h-[700px] flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                    Professional Clearing & Forwarding Services
                </h1>
                <p class="text-xl md:text-2xl mb-10 text-gray-200 max-w-3xl mx-auto">
                    Specializing in vehicle and heavy machinery clearance at Dar es Salaam Port. Your trusted partner for efficient cargo clearance and logistics coordination in Tanzania.
                </p>
                <div class="flex flex-wrap justify-center gap-4 mb-16">
                    <a href="{{ route('quote') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-10 py-4 rounded-full font-semibold text-lg transition transform hover:scale-105 shadow-lg">
                        Request a Quote
                    </a>
                    <a href="{{ route('services') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-900 text-white px-10 py-4 rounded-full font-semibold text-lg transition transform hover:scale-105">
                        Our Services
                    </a>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-400 mb-2">1000+</div>
                    <div class="text-lg text-gray-200">Vehicles Cleared</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-400 mb-2">15+</div>
                    <div class="text-lg text-gray-200">Years Experience</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-400 mb-2">98%</div>
                    <div class="text-lg text-gray-200">Client Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Introduction -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <div>
                <div class="text-sm font-semibold text-blue-600 mb-3 tracking-wider uppercase">WHO WE ARE</div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">Welcome to New Heroes International</h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    NEW HEROES INTERNATIONAL LIMITED is a professional clearing and forwarding company based in Dar es Salaam, Tanzania, 
                    specializing in cargo clearance services at major ports. We focus primarily on the clearance of motor vehicles, 
                    heavy machinery, and related cargo, ensuring efficient processing and delivery for clients.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    With strong expertise in port operations, customs regulations, and logistics coordination, we provide reliable 
                    solutions for individuals, businesses, and organizations importing goods through the port. We are committed to 
                    delivering efficient, transparent, and professional clearing services, ensuring smooth cargo movement from the 
                    port to the final destination.
                </p>
                <a href="{{ route('about') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-lg">
                    Learn More About Us
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('assets/images/bandari.webp') }}" alt="Port Operations" class="w-full h-96 object-cover">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-lg">
                    <div class="text-sm font-semibold text-gray-600 mb-1">OPERATING AT</div>
                    <div class="text-2xl font-bold text-blue-900">Dar es Salaam</div>
                    <div class="text-gray-600">Major Port Gateway</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Capabilities -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="text-sm font-semibold text-blue-600 mb-3 tracking-wider uppercase">OUR CAPABILITIES</div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Comprehensive Clearing Solutions</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Specialized expertise in vehicle and heavy machinery clearance at Dar es Salaam Port</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            <!-- Vehicle Clearing -->
            <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-blue-100 group">
                <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-car text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Vehicle Clearing</h3>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check text-blue-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Passenger Cars</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-blue-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Commercial Vehicles</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-blue-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Trucks & Buses</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-blue-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Motorcycles</span>
                    </li>
                </ul>
            </div>
            
            <!-- Heavy Machinery -->
            <div class="bg-gradient-to-br from-yellow-50 to-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-yellow-100 group">
                <div class="w-16 h-16 bg-yellow-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-truck-monster text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Heavy Machinery</h3>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Excavators & Bulldozers</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Cranes & Loaders</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Generators</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Agricultural Tractors</span>
                    </li>
                </ul>
            </div>
            
            <!-- Customs Documentation -->
            <div class="bg-gradient-to-br from-green-50 to-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-green-100 group">
                <div class="w-16 h-16 bg-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-file-invoice text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Customs Documentation</h3>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Import Permit Processing</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Duty Assessment</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Tax Computation</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Compliance Verification</span>
                    </li>
                </ul>
            </div>
            
            <!-- Port Operations -->
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-purple-100 group">
                <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-anchor text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Port Operations</h3>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Cargo Release Coordination</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Document Verification</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Storage Management</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-purple-600 mt-1 mr-3 flex-shrink-0"></i>
                        <span>Final Dispatch</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Visual Showcase -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto mt-16">
            <!-- RoRo Shipping -->
            <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('assets/images/roro-car-shipping-02.webp') }}" alt="RoRo Car Shipping" class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex items-end">
                    <div class="p-6 text-white">
                        <div class="text-sm font-semibold mb-2 text-yellow-400">SPECIALIZED HANDLING</div>
                        <h3 class="text-2xl font-bold mb-2">RoRo Vehicle Clearance</h3>
                        <p class="text-gray-200">Expert handling of Roll-on/Roll-off cargo with efficient port processing</p>
                    </div>
                </div>
            </div>
            
            <!-- Container Shipping -->
            <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('assets/images/Shipping-cars.jpg') }}" alt="Container Shipping" class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex items-end">
                    <div class="p-6 text-white">
                        <div class="text-sm font-semibold mb-2 text-yellow-400">CONTAINER SERVICES</div>
                        <h3 class="text-2xl font-bold mb-2">Containerized Cargo</h3>
                        <p class="text-gray-200">Professional clearance for vehicles and machinery shipped in containers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Services -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="text-sm font-semibold text-blue-600 mb-3 tracking-wider uppercase">WHAT WE OFFER</div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Services</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Comprehensive logistics solutions tailored to meet all your clearing and forwarding needs</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @forelse($featuredServices as $index => $service)
                <div class="group bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    @if($service->image)
                        <div class="relative overflow-hidden h-56">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                            <i class="fas fa-briefcase text-blue-600 text-6xl"></i>
                        </div>
                    @endif
                    <div class="p-8">
                        <div class="text-sm font-bold text-blue-600 mb-3">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">{{ $service->title }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">{{ $service->short_description }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold group-hover:gap-3 transition-all">
                            Discover More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">No services available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        @if($featuredServices->count() > 0)
            <div class="text-center mt-16">
                <a href="{{ route('services') }}" class="inline-block bg-blue-900 hover:bg-blue-800 text-white px-10 py-4 rounded-full font-semibold text-lg transition transform hover:scale-105 shadow-lg">
                    View All Services
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="text-sm font-semibold text-blue-600 mb-3 tracking-wider uppercase">WHY CHOOSE US</div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Excellence in Every Shipment</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Building long-term business relationships through trust, efficiency, and quality service</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <div class="group text-center p-8 rounded-2xl hover:bg-blue-50 transition-all duration-300">
                <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-user-tie text-blue-600 text-3xl group-hover:text-white transition-colors"></i>
                </div>
                <div class="text-lg font-bold text-blue-600 mb-2">01</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Professional Expertise</h3>
                <p class="text-gray-600 leading-relaxed">Strong knowledge of port procedures, customs regulations, and cargo logistics</p>
            </div>
            
            <div class="group text-center p-8 rounded-2xl hover:bg-blue-50 transition-all duration-300">
                <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-shipping-fast text-blue-600 text-3xl group-hover:text-white transition-colors"></i>
                </div>
                <div class="text-lg font-bold text-blue-600 mb-2">02</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Efficient Clearance</h3>
                <p class="text-gray-600 leading-relaxed">We work efficiently to ensure that cargo is cleared with minimal delays</p>
            </div>
            
            <div class="group text-center p-8 rounded-2xl hover:bg-blue-50 transition-all duration-300">
                <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-eye text-blue-600 text-3xl group-hover:text-white transition-colors"></i>
                </div>
                <div class="text-lg font-bold text-blue-600 mb-2">03</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Transparency</h3>
                <p class="text-gray-600 leading-relaxed">Clear communication with our clients throughout the clearance process</p>
            </div>
            
            <div class="group text-center p-8 rounded-2xl hover:bg-blue-50 transition-all duration-300">
                <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-handshake text-blue-600 text-3xl group-hover:text-white transition-colors"></i>
                </div>
                <div class="text-lg font-bold text-blue-600 mb-2">04</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Reliability</h3>
                <p class="text-gray-600 leading-relaxed">Clients trust us to handle their cargo professionally and responsibly</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="text-sm font-semibold text-blue-600 mb-3 tracking-wider uppercase">TESTIMONIALS</div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">What Our Clients Say</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Trusted by businesses across Tanzania and beyond</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center gap-1 mb-6">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star text-yellow-400 text-lg"></i>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed text-lg italic">"{{ $testimonial->testimonial }}"</p>
                    <div class="flex items-center pt-6 border-t border-gray-100">
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->client_name }}" class="w-14 h-14 rounded-full mr-4 object-cover">
                        @else
                            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                <i class="fas fa-user text-blue-600 text-xl"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $testimonial->client_name }}</h4>
                            @if($testimonial->company_name)
                                <p class="text-sm text-gray-500">{{ $testimonial->company_name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="relative py-24 text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/images/Shipping-cars.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-blue-900/60 to-black/70"></div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-10 text-gray-200 max-w-2xl mx-auto">Contact us today for a free quote and experience seamless logistics solutions tailored to your needs</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('quote') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-10 py-4 rounded-full font-semibold text-lg transition transform hover:scale-105 shadow-lg">
                Request a Quote
            </a>
            <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-900 text-white px-10 py-4 rounded-full font-semibold text-lg transition transform hover:scale-105">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
