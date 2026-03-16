@extends('admin.layouts.app')

@section('title', 'Create Page Section')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.pages.index') }}" class="hover:text-blue-600">Pages</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <a href="{{ route('admin.pages.edit', $page) }}" class="hover:text-blue-600">{{ $page->title }}</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">New Section</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Add Section to {{ $page->title }}</h1>
</div>

<!-- Quick Templates -->
<div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-3">
        <i class="fas fa-magic text-blue-600 mr-2"></i>Quick Templates
    </h3>
    <p class="text-sm text-gray-600 mb-4">Click a template to auto-fill the form</p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <button type="button" onclick="fillTemplate('mission')" class="bg-white border-2 border-blue-200 hover:border-blue-400 rounded-lg p-4 text-left transition group">
            <div class="flex items-center mb-2">
                <i class="fas fa-bullseye text-blue-600 text-xl mr-3"></i>
                <span class="font-bold text-gray-900">Our Mission</span>
            </div>
            <p class="text-xs text-gray-600">Company mission statement</p>
        </button>
        
        <button type="button" onclick="fillTemplate('vision')" class="bg-white border-2 border-purple-200 hover:border-purple-400 rounded-lg p-4 text-left transition group">
            <div class="flex items-center mb-2">
                <i class="fas fa-eye text-purple-600 text-xl mr-3"></i>
                <span class="font-bold text-gray-900">Our Vision</span>
            </div>
            <p class="text-xs text-gray-600">Company vision statement</p>
        </button>
        
        <button type="button" onclick="fillTemplate('values')" class="bg-white border-2 border-green-200 hover:border-green-400 rounded-lg p-4 text-left transition group">
            <div class="flex items-center mb-2">
                <i class="fas fa-heart text-green-600 text-xl mr-3"></i>
                <span class="font-bold text-gray-900">Our Values</span>
            </div>
            <p class="text-xs text-gray-600">Core company values</p>
        </button>
        
        <button type="button" onclick="fillTemplate('team')" class="bg-white border-2 border-yellow-200 hover:border-yellow-400 rounded-lg p-4 text-left transition group">
            <div class="flex items-center mb-2">
                <i class="fas fa-users text-yellow-600 text-xl mr-3"></i>
                <span class="font-bold text-gray-900">Our Team</span>
            </div>
            <p class="text-xs text-gray-600">Team introduction</p>
        </button>
        
        <button type="button" onclick="fillTemplate('history')" class="bg-white border-2 border-red-200 hover:border-red-400 rounded-lg p-4 text-left transition group">
            <div class="flex items-center mb-2">
                <i class="fas fa-history text-red-600 text-xl mr-3"></i>
                <span class="font-bold text-gray-900">Our History</span>
            </div>
            <p class="text-xs text-gray-600">Company history</p>
        </button>
        
        <button type="button" onclick="fillTemplate('custom')" class="bg-white border-2 border-gray-200 hover:border-gray-400 rounded-lg p-4 text-left transition group">
            <div class="flex items-center mb-2">
                <i class="fas fa-plus-circle text-gray-600 text-xl mr-3"></i>
                <span class="font-bold text-gray-900">Custom Section</span>
            </div>
            <p class="text-xs text-gray-600">Start from scratch</p>
        </button>
    </div>
</div>

<form action="{{ route('admin.page-sections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <input type="hidden" name="page_id" value="{{ $page->id }}">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>Section Information
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="section_key" class="block text-sm font-medium text-gray-700 mb-1">Section Key *</label>
                        <input type="text" name="section_key" id="section_key" value="{{ old('section_key') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('section_key') border-red-500 @enderror"
                            placeholder="e.g., mission, vision, overview">
                        <p class="mt-1 text-xs text-gray-500">Unique identifier for this section (lowercase, no spaces)</p>
                        @error('section_key')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="e.g., Our Mission">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subtitle') border-red-500 @enderror"
                            placeholder="Optional subtitle text">
                        @error('subtitle')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea name="content" id="content" rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            placeholder="Section content (HTML supported)">{{ old('content') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">You can use HTML tags for formatting</p>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Section Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Optional image for this section</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                            <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('button_text') border-red-500 @enderror"
                                placeholder="e.g., Learn More">
                            @error('button_text')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="button_link" class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
                            <input type="text" name="button_link" id="button_link" value="{{ old('button_link') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('button_link') border-red-500 @enderror"
                                placeholder="/services">
                            @error('button_link')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Section Order & Status -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Settings</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $page->sections->count() + 1) }}" min="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                    </div>

                    <div>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Active (visible on page)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="space-y-3">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Create Section
                    </button>
                    
                    <a href="{{ route('admin.pages.edit', $page) }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    const templates = {
        mission: {
            section_key: 'mission',
            title: 'Our Mission',
            subtitle: 'What drives us every day',
            content: `<p>To provide efficient, reliable, and professional clearing and forwarding services that simplify cargo clearance processes while ensuring full compliance with customs regulations and industry standards.</p>
<p>We are committed to delivering exceptional value to our clients through innovation, integrity, and dedication to excellence in every shipment we handle.</p>`
        },
        vision: {
            section_key: 'vision',
            title: 'Our Vision',
            subtitle: 'Where we aim to be',
            content: `<p>To become a trusted and leading clearing and forwarding company in Tanzania, recognized for professionalism, reliability, and excellence in cargo logistics services.</p>
<p>We aspire to be the first choice for businesses and individuals seeking seamless port clearance and logistics solutions in East Africa.</p>`
        },
        values: {
            section_key: 'values',
            title: 'Our Core Values',
            subtitle: 'The principles that guide us',
            content: `<ul class="space-y-3">
    <li><strong>Integrity:</strong> We conduct our business with honesty and transparency in all dealings.</li>
    <li><strong>Excellence:</strong> We strive for the highest standards in every service we provide.</li>
    <li><strong>Customer Focus:</strong> Our clients' success is our primary concern and motivation.</li>
    <li><strong>Reliability:</strong> We deliver on our promises consistently and dependably.</li>
    <li><strong>Innovation:</strong> We continuously improve our processes to serve you better.</li>
    <li><strong>Teamwork:</strong> We work together to achieve common goals and exceptional results.</li>
</ul>`
        },
        team: {
            section_key: 'team',
            title: 'Our Team',
            subtitle: 'Meet the people behind our success',
            content: `<p>Our team consists of experienced professionals with deep expertise in clearing and forwarding, customs regulations, and logistics coordination. Each member brings unique skills and knowledge that contribute to our collective success.</p>
<p>With years of experience in the industry, our staff is dedicated to providing personalized service and expert guidance to help you navigate the complexities of cargo clearance at Dar es Salaam Port.</p>`
        },
        history: {
            section_key: 'history',
            title: 'Our History',
            subtitle: 'Our journey so far',
            content: `<p>NEW HEROES INTERNATIONAL LIMITED was established with a vision to simplify the clearing and forwarding process for businesses and individuals in Tanzania.</p>
<p>Since our inception, we have grown from a small operation to become a trusted name in cargo clearance services at Dar es Salaam Port. Our commitment to excellence and customer satisfaction has been the cornerstone of our growth.</p>
<p>Today, we continue to expand our services and capabilities while maintaining the personal touch and attention to detail that our clients have come to expect.</p>`
        },
        custom: {
            section_key: '',
            title: '',
            subtitle: '',
            content: ''
        }
    };

    function fillTemplate(templateName) {
        const template = templates[templateName];
        if (!template) return;

        // Fill form fields
        document.getElementById('section_key').value = template.section_key;
        document.getElementById('title').value = template.title;
        document.getElementById('subtitle').value = template.subtitle;
        document.getElementById('content').value = template.content;

        // Scroll to form
        document.querySelector('form').scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Show success message
        showToast(`Template "${templateName}" loaded! You can now customize it.`, 'info');
    }
</script>
@endpush

@endsection
