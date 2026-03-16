<?php $__env->startSection('title', 'Contact Us - New Heroes International'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="relative bg-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                GET IN TOUCH
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Contact Us
            </h1>
            <p class="text-2xl text-gray-600 leading-relaxed">
                We're here to help with your cargo clearing needs
            </p>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-5 gap-12">
                <!-- Contact Form -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10">
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-3">Send Us a Message</h2>
                            <p class="text-gray-600">Fill out the form below and we'll get back to you as soon as possible.</p>
                        </div>

                        <?php if(session('success')): ?>
                            <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-6 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-check text-green-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-green-900 mb-1">Message Sent Successfully!</h4>
                                        <p class="text-green-700"><?php echo e(session('success')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('contact.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Your Name *</label>
                                    <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required
                                        class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="John Doe">
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($message); ?>

                                        </p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email Address *</label>
                                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required
                                            class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="john@example.com">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($message); ?>

                                            </p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">Phone Number</label>
                                        <input type="tel" name="phone" id="phone" value="<?php echo e(old('phone')); ?>"
                                            class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="+255 XXX XXX XXX">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($message); ?>

                                            </p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-semibold text-gray-900 mb-2">Subject *</label>
                                    <input type="text" name="subject" id="subject" value="<?php echo e(old('subject')); ?>" required
                                        class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="How can we help you?">
                                    <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($message); ?>

                                        </p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">Message *</label>
                                    <textarea name="message" id="message" rows="6" required
                                        class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Tell us about your cargo clearing needs..."><?php echo e(old('message')); ?></textarea>
                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($message); ?>

                                        </p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <button type="submit" class="w-full px-8 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 hover:scale-105 transition text-lg">
                                    <i class="fas fa-paper-plane mr-2"></i> Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Information Sidebar -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Contact Info Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h3>

                        <div class="space-y-6">
                            <?php $__currentLoopData = $contactInfo->groupBy('group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($group): ?>
                                    <div>
                                        <h4 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-4"><?php echo e($group); ?></h4>
                                        <div class="space-y-4">
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="flex items-start">
                                                    <?php if(Str::contains($info->key, 'phone')): ?>
                                                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                                            <i class="fas fa-phone text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1"><?php echo e(ucfirst(str_replace('_', ' ', $info->key))); ?></p>
                                                            <a href="tel:<?php echo e($info->value); ?>" class="text-gray-900 font-semibold hover:text-blue-600 transition"><?php echo e($info->value); ?></a>
                                                        </div>
                                                    <?php elseif(Str::contains($info->key, 'email')): ?>
                                                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                                            <i class="fas fa-envelope text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1"><?php echo e(ucfirst(str_replace('_', ' ', $info->key))); ?></p>
                                                            <a href="mailto:<?php echo e($info->value); ?>" class="text-gray-900 font-semibold hover:text-blue-600 transition break-all"><?php echo e($info->value); ?></a>
                                                        </div>
                                                    <?php elseif(Str::contains($info->key, 'address')): ?>
                                                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                                            <i class="fas fa-map-marker-alt text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1"><?php echo e(ucfirst(str_replace('_', ' ', $info->key))); ?></p>
                                                            <p class="text-gray-900 font-semibold"><?php echo e($info->value); ?></p>
                                                        </div>
                                                    <?php elseif(Str::contains($info->key, ['facebook', 'twitter', 'linkedin', 'instagram', 'whatsapp', 'youtube'])): ?>
                                                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                                            <i class="fab fa-<?php echo e($info->key); ?> text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1"><?php echo e(ucfirst($info->key)); ?></p>
                                                            <a href="<?php echo e($info->value); ?>" target="_blank" class="text-gray-900 font-semibold hover:text-blue-600 transition">Follow us</a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                                            <i class="fas fa-info-circle text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1"><?php echo e(ucfirst(str_replace('_', ' ', $info->key))); ?></p>
                                                            <p class="text-gray-900 font-semibold"><?php echo e($info->value); ?></p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Business Hours Card -->
                    <?php
                        $workingHours = \App\Models\ContactInformation::getByKey('working_hours', 'Monday - Friday: 8:00 AM - 5:00 PM, Saturday: 8:00 AM - 1:00 PM');
                    ?>
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white rounded-3xl p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-clock text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold">Business Hours</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="py-2">
                                <p class="text-white leading-relaxed"><?php echo e($workingHours); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links Card -->
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Quick Links</h3>
                        <div class="space-y-3">
                            <a href="<?php echo e(route('quote')); ?>" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <i class="fas fa-file-alt mr-3 text-blue-600"></i>
                                <span class="group-hover:translate-x-1 transition-transform">Request a Quote</span>
                            </a>
                            <a href="<?php echo e(route('services')); ?>" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <i class="fas fa-briefcase mr-3 text-blue-600"></i>
                                <span class="group-hover:translate-x-1 transition-transform">Our Services</span>
                            </a>
                            <a href="<?php echo e(route('process')); ?>" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <i class="fas fa-tasks mr-3 text-blue-600"></i>
                                <span class="group-hover:translate-x-1 transition-transform">Clearance Process</span>
                            </a>
                            <a href="<?php echo e(route('blog')); ?>" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                                <i class="fas fa-blog mr-3 text-blue-600"></i>
                                <span class="group-hover:translate-x-1 transition-transform">Blog & Resources</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <?php
                $officeAddress = \App\Models\ContactInformation::getByKey('address', 'Leader House Floor 1 Room 120, Dar es Salaam, Tanzania');
            ?>
            <div class="text-center mb-12">
                <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-4">
                    FIND US
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Visit Our Office</h2>
                <div class="text-lg text-gray-600">
                    <p class="font-semibold"><?php echo e($officeAddress); ?></p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-gray-200 to-gray-300 rounded-3xl shadow-xl h-96 flex items-center justify-center overflow-hidden">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/80 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-blue-600 text-4xl"></i>
                    </div>
                    <p class="text-gray-700 font-semibold text-lg mb-2">Interactive Map</p>
                    <p class="text-gray-600">Google Maps integration available</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<?php
    $primaryPhone = \App\Models\ContactInformation::getByKey('phone1', '+255625544404');
    $whatsappNumber = \App\Models\ContactInformation::getByKey('whatsapp', $primaryPhone);
    $whatsappLink = 'https://wa.me/' . str_replace([' ', '+', '-'], '', $whatsappNumber);
    $phoneLink = 'tel:' . str_replace(' ', '', $primaryPhone);
?>
<div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Need Immediate Assistance?</h2>
            <p class="text-xl text-blue-100 mb-8">
                Our team is ready to help you with your cargo clearing needs
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo e($phoneLink); ?>" class="px-8 py-4 bg-white text-blue-600 rounded-full font-semibold hover:bg-blue-50 hover:scale-105 transition">
                    <i class="fas fa-phone mr-2"></i> Call Us Now
                </a>
                <a href="<?php echo e($whatsappLink); ?>" target="_blank" class="px-8 py-4 bg-green-500 text-white rounded-full font-semibold hover:bg-green-600 hover:scale-105 transition">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbook/Documents/Projects/New_heros/resources/views/web/contact.blade.php ENDPATH**/ ?>