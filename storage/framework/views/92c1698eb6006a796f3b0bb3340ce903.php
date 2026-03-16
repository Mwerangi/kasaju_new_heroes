<?php $__env->startSection('title', 'Request a Quote'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="relative bg-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                GET A FREE QUOTE
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Request a Quote
            </h1>
            <p class="text-2xl text-gray-600 leading-relaxed">
                Get a free, no-obligation quote for your cargo clearance needs
            </p>
        </div>
    </div>
</div>

<!-- Quote Form Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <?php if(session('success')): ?>
                <div class="mb-12 bg-green-50 border-l-4 border-green-500 rounded-2xl p-8 shadow-sm">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-check text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-900 text-lg mb-1">Quote Request Submitted Successfully!</h4>
                            <p class="text-green-700"><?php echo e(session('success')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if($errors->any()): ?>
                <div class="mb-12 bg-red-50 border-l-4 border-red-500 rounded-2xl p-8 shadow-sm">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-red-900 text-lg mb-3">Please fix the following errors:</h4>
                            <ul class="space-y-2">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="text-red-700 flex items-center">
                                        <i class="fas fa-times-circle mr-2 text-sm"></i><?php echo e($error); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10">
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-3">Fill Out the Form</h2>
                    <p class="text-gray-600 text-lg">Provide details about your cargo and we'll get back to you within 24 hours</p>
                </div>

                <form method="POST" action="<?php echo e(route('quote.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    <div class="space-y-8">
                        <!-- Personal Information -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                Personal Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="full_name" class="block text-sm font-semibold text-gray-900 mb-2">Full Name *</label>
                                    <input type="text" id="full_name" name="full_name" value="<?php echo e(old('full_name')); ?>" required
                                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                           placeholder="John Doe">
                                </div>
                                
                                <div>
                                    <label for="company_name" class="block text-sm font-semibold text-gray-900 mb-2">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" value="<?php echo e(old('company_name')); ?>"
                                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                           placeholder="ABC Corporation (Optional)">
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" required
                                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                           placeholder="+255 XXX XXX XXX">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email Address *</label>
                                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                           placeholder="john@example.com">
                                </div>
                            </div>
                        </div>

                        <!-- Cargo Information -->
                        <div class="pt-8 border-t border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-box text-blue-600"></i>
                                </div>
                                Cargo Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="cargo_type" class="block text-sm font-semibold text-gray-900 mb-2">Cargo Type *</label>
                                    <select id="cargo_type" name="cargo_type" required class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                                        <option value="">Select cargo type</option>
                                        <option value="vehicle" <?php echo e(old('cargo_type') == 'vehicle' ? 'selected' : ''); ?>>Motor Vehicle</option>
                                        <option value="heavy_machinery" <?php echo e(old('cargo_type') == 'heavy_machinery' ? 'selected' : ''); ?>>Heavy Machinery</option>
                                        <option value="construction_equipment" <?php echo e(old('cargo_type') == 'construction_equipment' ? 'selected' : ''); ?>>Construction Equipment</option>
                                        <option value="general_cargo" <?php echo e(old('cargo_type') == 'general_cargo' ? 'selected' : ''); ?>>General Cargo</option>
                                        <option value="other" <?php echo e(old('cargo_type') == 'other' ? 'selected' : ''); ?>>Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="vehicle_type" class="block text-sm font-semibold text-gray-900 mb-2">Vehicle/Equipment Description</label>
                                    <input type="text" id="vehicle_type" name="vehicle_type" value="<?php echo e(old('vehicle_type')); ?>"
                                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                           placeholder="e.g., Toyota Land Cruiser, Excavator CAT 320">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="port_of_arrival" class="block text-sm font-semibold text-gray-900 mb-2">Port of Arrival</label>
                                    <input type="text" id="port_of_arrival" name="port_of_arrival" value="<?php echo e(old('port_of_arrival', 'Dar es Salaam Port')); ?>"
                                           class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                           placeholder="Dar es Salaam Port">
                                </div>
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div class="pt-8 border-t border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle text-blue-600"></i>
                                </div>
                                Additional Details
                            </h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">Message / Special Requirements *</label>
                                    <textarea id="message" name="message" rows="6" required
                                              class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                              placeholder="Please provide any additional details about your cargo, expected arrival date, special handling requirements, or questions you may have..."><?php echo e(old('message')); ?></textarea>
                                </div>
                                
                                <div>
                                    <label for="attachment" class="block text-sm font-semibold text-gray-900 mb-2">Attachment (Optional)</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition">
                                        <input type="file" id="attachment" name="attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                               class="hidden"
                                               onchange="updateFileName(this)">
                                        <label for="attachment" class="cursor-pointer">
                                            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-cloud-upload-alt text-blue-600 text-3xl"></i>
                                            </div>
                                            <p class="text-gray-900 font-semibold mb-2">Click to upload documents</p>
                                            <p class="text-sm text-gray-500" id="file-name">PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10 pt-8 border-t border-gray-200">
                        <button type="submit" class="w-full px-8 py-5 bg-blue-600 text-white rounded-full font-bold hover:bg-blue-700 hover:scale-105 transition text-lg shadow-lg">
                            <i class="fas fa-paper-plane mr-2"></i>Submit Quote Request
                        </button>
                        <p class="text-center text-gray-500 text-sm mt-4">We'll respond within 24 hours</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Alternative Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                NEED IMMEDIATE ASSISTANCE?
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Or Contact Us Directly</h2>
            <p class="text-xl text-gray-600 mb-10">
                Our team is available to answer your questions and provide immediate assistance
            </p>
            
            <div class="grid md:grid-cols-3 gap-6">
                <a href="tel:+255625544404" class="bg-white rounded-2xl p-8 hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-phone text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Call Us</h3>
                    <p class="text-blue-600 font-semibold">+255 625 544 404</p>
                </a>
                
                <a href="https://wa.me/255625544404" target="_blank" class="bg-white rounded-2xl p-8 hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                        <i class="fab fa-whatsapp text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">WhatsApp</h3>
                    <p class="text-green-600 font-semibold">Chat with us</p>
                </a>
                
                <a href="mailto:info@newheroesintl.com" class="bg-white rounded-2xl p-8 hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-envelope text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Email Us</h3>
                    <p class="text-purple-600 font-semibold">Send an email</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Why Request a Quote From Us?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Experience professional cargo clearing services backed by expertise and reliability
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fast Response</h3>
                    <p class="text-gray-600">Get your quote within 24 hours</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-dollar-sign text-green-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transparent Pricing</h3>
                    <p class="text-gray-600">No hidden fees or surprises</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Professional Service</h3>
                    <p class="text-gray-600">Experienced team handling your cargo</p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-headset text-orange-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-600">Always available to assist you</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
function updateFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameElement = document.getElementById('file-name');
    if (fileName) {
        fileNameElement.textContent = `Selected: ${fileName}`;
        fileNameElement.classList.add('text-blue-600', 'font-semibold');
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbook/Documents/Projects/New_heros/resources/views/web/quote.blade.php ENDPATH**/ ?>