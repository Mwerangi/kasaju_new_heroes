@extends('web.layouts.app')

@section('title', 'About Us - New Heroes International')

@section('content')
<!-- Page Header -->
<div class="relative py-24 text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/images/bandari.webp') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-blue-900/60 to-black/70"></div>
    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="text-sm font-semibold text-yellow-400 mb-3 tracking-wider uppercase">WHO WE ARE</div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">About Us</h1>
        <p class="text-xl text-gray-200 max-w-2xl mx-auto">Professional clearing and forwarding services at Dar es Salaam Port</p>
    </div>
</div>

<!-- Page Content -->
<div class="py-16">
    <div class="container mx-auto px-4">
        @if($page && $page->sections->count() > 0)
            <!-- Dynamic Content from Database -->
            <div class="max-w-6xl mx-auto">
                @foreach($page->sections as $section)
                    <div class="mb-12">
                        @if($section->title)
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $section->title }}</h2>
                        @endif
                        
                        @if($section->subtitle)
                            <h3 class="text-xl text-gray-600 mb-4">{{ $section->subtitle }}</h3>
                        @endif
                        
                        <div class="grid gap-8 {{ $section->image ? 'md:grid-cols-2 items-center' : 'grid-cols-1' }}">
                            @if($section->image)
                                <div class="order-{{ $section->additional_data['image_position'] ?? 'left' == 'right' ? '2' : '1' }}">
                                    <img src="{{ asset('storage/' . $section->image) }}" 
                                         alt="{{ $section->title }}" 
                                         class="rounded-xl shadow-lg w-full h-auto">
                                </div>
                            @endif
                            
                            <div class="{{ $section->image ? 'order-' . ($section->additional_data['image_position'] ?? 'left' == 'right' ? '1' : '2') : '' }}">
                                @if($section->content)
                                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                        {!! $section->content !!}
                                    </div>
                                @endif
                                
                                @if($section->button_text && $section->button_link)
                                    <div class="mt-6">
                                        <a href="{{ $section->button_link }}" 
                                           class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                                            {{ $section->button_text }}
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        @if($section->additional_data && isset($section->additional_data['cards']))
                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                                @foreach($section->additional_data['cards'] as $card)
                                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                                        @if(!empty($card['icon']))
                                            <i class="{{ $card['icon'] }} text-blue-600 text-3xl mb-4"></i>
                                        @endif
                                        @if(!empty($card['title']))
                                            <h4 class="text-xl font-bold text-gray-900 mb-3">{{ $card['title'] }}</h4>
                                        @endif
                                        @if(!empty($card['content']))
                                            <p class="text-gray-600">{{ $card['content'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <!-- Default About Content if no page found -->
            <div class="max-w-6xl mx-auto">
                <!-- Company Overview -->
                <div class="mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Company Overview</h2>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-4">
                        <p>
                            NEW HEROES INTERNATIONAL LIMITED is a professional clearing and forwarding company based in Dar es Salaam, Tanzania, 
                            specializing in cargo clearance services at major ports. The company focuses primarily on the clearance of motor vehicles, 
                            heavy machinery, and related cargo, ensuring efficient processing and delivery for clients.
                        </p>
                        <p>
                            With strong expertise in port operations, customs regulations, and logistics coordination, the company provides reliable 
                            solutions for individuals, businesses, and organizations importing goods through the port.
                        </p>
                        <p>
                            NEW HEROES INTERNATIONAL LIMITED is committed to delivering efficient, transparent, and professional clearing services, 
                            ensuring smooth cargo movement from the port to the final destination.
                        </p>
                    </div>
                </div>

                <!-- Mission & Vision -->
                <div class="grid md:grid-cols-2 gap-12 mb-16">
                    <div class="bg-blue-50 p-8 rounded-2xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-bullseye text-blue-600 text-3xl mr-4"></i>
                            <h3 class="text-2xl font-bold text-gray-900">Our Mission</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            To provide efficient, reliable, and professional clearing and forwarding services that simplify cargo clearance 
                            processes while ensuring full compliance with customs regulations and industry standards.
                        </p>
                    </div>
                    <div class="bg-yellow-50 p-8 rounded-2xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-eye text-yellow-600 text-3xl mr-4"></i>
                            <h3 class="text-2xl font-bold text-gray-900">Our Vision</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            To become a trusted and leading clearing and forwarding company in Tanzania, recognized for professionalism, 
                            reliability, and excellence in cargo logistics services.
                        </p>
                    </div>
                </div>

                <!-- Core Services -->
                <div class="mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">Our Core Services</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Vehicle Clearing -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                            <div class="flex items-start mb-4">
                                <i class="fas fa-car text-blue-600 text-3xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Vehicle Clearing Services</h4>
                                    <p class="text-gray-600 mb-3">We specialize in the clearance of all types of imported motor vehicles including:</p>
                                    <ul class="text-gray-600 space-y-1 list-disc list-inside">
                                        <li>Passenger vehicles</li>
                                        <li>Commercial vehicles</li>
                                        <li>Trucks and trailers</li>
                                        <li>Buses</li>
                                        <li>Specialized vehicles</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Heavy Machinery -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                            <div class="flex items-start mb-4">
                                <i class="fas fa-tractor text-blue-600 text-3xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Heavy Machinery Clearing</h4>
                                    <p class="text-gray-600 mb-3">We handle the clearance of various types of industrial and construction equipment:</p>
                                    <ul class="text-gray-600 space-y-1 list-disc list-inside">
                                        <li>Excavators</li>
                                        <li>Bulldozers</li>
                                        <li>Cranes</li>
                                        <li>Loaders</li>
                                        <li>Road construction equipment</li>
                                        <li>Agricultural machinery</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Customs Documentation -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                            <div class="flex items-start mb-4">
                                <i class="fas fa-file-alt text-blue-600 text-3xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Customs Documentation & Processing</h4>
                                    <p class="text-gray-600 mb-3">We assist clients with all required customs documentation:</p>
                                    <ul class="text-gray-600 space-y-1 list-disc list-inside">
                                        <li>Import declaration processing</li>
                                        <li>Duty and tax assessment coordination</li>
                                        <li>Cargo inspection procedures</li>
                                        <li>Customs clearance documentation</li>
                                        <li>Port authority compliance</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Port Cargo Handling -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                            <div class="flex items-start mb-4">
                                <i class="fas fa-anchor text-blue-600 text-3xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Port Cargo Handling</h4>
                                    <p class="text-gray-600 mb-3">Our team provides support in managing cargo procedures within the port:</p>
                                    <ul class="text-gray-600 space-y-1 list-disc list-inside">
                                        <li>Cargo processing and release</li>
                                        <li>Shipping documentation coordination</li>
                                        <li>Port clearance procedures</li>
                                        <li>Cargo verification and handling</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Logistics Coordination - spanning 2 columns -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition md:col-span-2">
                            <div class="flex items-start mb-4">
                                <i class="fas fa-route text-blue-600 text-3xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">Logistics Coordination</h4>
                                    <p class="text-gray-600 mb-3">Once cargo clearance is completed, we assist with logistics coordination including:</p>
                                    <ul class="text-gray-600 space-y-1 list-disc list-inside grid md:grid-cols-2 gap-x-8">
                                        <li>Transportation arrangement</li>
                                        <li>Vehicle dispatch from port</li>
                                        <li>Machinery transport coordination</li>
                                        <li>Cargo delivery to final destination</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Our Clients -->
                <div class="bg-gray-50 p-8 rounded-2xl mb-16">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6 text-center">Our Clients</h3>
                    <p class="text-gray-700 leading-relaxed text-center mb-6">
                        Our services support a wide range of clients including:
                    </p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-4xl mx-auto">
                        <div class="text-center p-4 bg-white rounded-lg">
                            <i class="fas fa-car-side text-blue-600 text-2xl mb-2"></i>
                            <p class="text-gray-700 font-semibold">Vehicle Importers & Dealers</p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg">
                            <i class="fas fa-building text-blue-600 text-2xl mb-2"></i>
                            <p class="text-gray-700 font-semibold">Construction Companies</p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg">
                            <i class="fas fa-tools text-blue-600 text-2xl mb-2"></i>
                            <p class="text-gray-700 font-semibold">Equipment Suppliers</p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg">
                            <i class="fas fa-hard-hat text-blue-600 text-2xl mb-2"></i>
                            <p class="text-gray-700 font-semibold">Contractors</p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg">
                            <i class="fas fa-truck text-blue-600 text-2xl mb-2"></i>
                            <p class="text-gray-700 font-semibold">Logistics Companies</p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg">
                            <i class="fas fa-user text-blue-600 text-2xl mb-2"></i>
                            <p class="text-gray-700 font-semibold">Individual Importers</p>
                        </div>
                    </div>
                </div>

                <!-- Operating Area -->
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Operating Area</h3>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                        Our operations are primarily focused around <strong>Dar es Salaam Port</strong>, which serves as a major gateway 
                        for cargo entering Tanzania and neighboring countries.
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- CTA Section -->
<div class="relative py-20 text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/images/Shipping-cars.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-blue-900/60 to-black/70"></div>
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-4">Ready to Work With Us?</h2>
        <p class="text-xl text-gray-200 mb-10 max-w-2xl mx-auto">Let's discuss how we can help with your logistics needs</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('quote') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-10 py-4 rounded-full font-semibold text-lg transition transform hover:scale-105 shadow-lg">
                Request a Quote
            </a>
            <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-900 text-white px-10 py-4 rounded-full font-semibold text-lg transition transform hover:scale-105">
                Contact Us
            </a>
        </div>
    </div>
</div>
@endsection
