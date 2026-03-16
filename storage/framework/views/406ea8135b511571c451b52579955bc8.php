<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo $__env->yieldContent('title', \App\Helpers\SeoHelper::getMetaTitle(request()->segment(1) ?: 'home')); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', \App\Helpers\SeoHelper::getMetaDescription(request()->segment(1) ?: 'home', 'New Heroes International Limited - Professional Clearing and Forwarding Services in Tanzania')); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', \App\Helpers\SeoHelper::getMetaKeywords(request()->segment(1) ?: 'home', 'clearing, forwarding, logistics, cargo, Tanzania, Dar es Salaam')); ?>">
    <link rel="canonical" href="<?php echo e(\App\Helpers\SeoHelper::getCanonicalUrl(request()->segment(1) ?: 'home')); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', \App\Helpers\SeoHelper::getOgTitle(request()->segment(1) ?: 'home')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', \App\Helpers\SeoHelper::getOgDescription(request()->segment(1) ?: 'home')); ?>">
    <?php if(\App\Helpers\SeoHelper::getOgImage(request()->segment(1) ?: 'home')): ?>
        <meta property="og:image" content="<?php echo e(\App\Helpers\SeoHelper::getOgImage(request()->segment(1) ?: 'home')); ?>">
    <?php endif; ?>
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta property="twitter:title" content="<?php echo $__env->yieldContent('og_title', \App\Helpers\SeoHelper::getOgTitle(request()->segment(1) ?: 'home')); ?>">
    <meta property="twitter:description" content="<?php echo $__env->yieldContent('og_description', \App\Helpers\SeoHelper::getOgDescription(request()->segment(1) ?: 'home')); ?>">
    <?php if(\App\Helpers\SeoHelper::getOgImage(request()->segment(1) ?: 'home')): ?>
        <meta property="twitter:image" content="<?php echo e(\App\Helpers\SeoHelper::getOgImage(request()->segment(1) ?: 'home')); ?>">
    <?php endif; ?>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-gradient {
            background: url('/assets/images/Shipping-cars.jpg') center/cover no-repeat;
            position: relative;
        }
        
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(30, 58, 138, 0.4) 100%);
            z-index: 1;
        }
        
        .hero-gradient > * {
            position: relative;
            z-index: 2;
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #1e3a8a;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #1e40af;
        }
        
        /* Section animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-white">
    <?php
        // Load contact info once for the entire layout
        $phone1 = \App\Models\ContactInformation::getByKey('phone1', '+255 625 544 404');
        $phone2 = \App\Models\ContactInformation::getByKey('phone2', '+255 742 058 897');
        $email = \App\Models\ContactInformation::getByKey('email', 'info@newheroesintl.com');
        $address = \App\Models\ContactInformation::getByKey('address', 'Leader House, Dar es Salaam, Tanzania');
        $whatsapp = \App\Models\ContactInformation::getByKey('whatsapp', $phone1);
    ?>
    <!-- Top Bar -->
    <div class="bg-gray-900 text-white py-3 border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between items-center text-sm">
                <div class="flex flex-wrap gap-6">
                    <a href="tel:<?php echo e(str_replace(' ', '', $phone1)); ?>" class="flex items-center gap-2 hover:text-yellow-400 transition">
                        <i class="fas fa-phone"></i>
                        <span><?php echo e($phone1); ?></span>
                    </a>
                    <a href="https://wa.me/<?php echo e(str_replace([' ', '+', '-'], '', $whatsapp)); ?>" target="_blank" class="flex items-center gap-2 hover:text-yellow-400 transition">
                        <i class="fab fa-whatsapp"></i>
                        <span><?php echo e($phone2); ?></span>
                    </a>
                    <a href="mailto:<?php echo e($email); ?>" class="flex items-center gap-2 hover:text-yellow-400 transition">
                        <i class="fas fa-envelope"></i>
                        <span><?php echo e($email); ?></span>
                    </a>
                </div>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-yellow-400 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-yellow-400 transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-yellow-400 transition"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="hover:text-yellow-400 transition"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-5">
                <a href="<?php echo e(route('home')); ?>" class="text-3xl font-bold text-gray-900 hover:text-blue-900 transition">
                    NEW HEROES<span class="text-yellow-500"> INTERNATIONAL LIMITED</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="text-gray-700 hover:text-blue-600 font-medium transition <?php echo e(request()->routeIs('home') ? 'text-blue-600' : ''); ?>">Home</a>
                    <a href="<?php echo e(route('about')); ?>" class="text-gray-700 hover:text-blue-600 font-medium transition <?php echo e(request()->routeIs('about') ? 'text-blue-600' : ''); ?>">About</a>
                    <a href="<?php echo e(route('services')); ?>" class="text-gray-700 hover:text-blue-600 font-medium transition <?php echo e(request()->routeIs('services*') ? 'text-blue-600' : ''); ?>">Services</a>
                    <a href="<?php echo e(route('process')); ?>" class="text-gray-700 hover:text-blue-600 font-medium transition <?php echo e(request()->routeIs('process') ? 'text-blue-600' : ''); ?>">Process</a>
                    <a href="<?php echo e(route('gallery')); ?>" class="text-gray-700 hover:text-blue-600 font-medium transition <?php echo e(request()->routeIs('gallery') ? 'text-blue-600' : ''); ?>">Gallery</a>
                    <a href="<?php echo e(route('blog')); ?>" class="text-gray-700 hover:text-blue-600 font-medium transition <?php echo e(request()->routeIs('blog*') ? 'text-blue-600' : ''); ?>">Blog</a>
                    <a href="<?php echo e(route('contact')); ?>" class="text-gray-700 hover:text-blue-600 font-medium transition <?php echo e(request()->routeIs('contact') ? 'text-blue-600' : ''); ?>">Contact</a>
                    <a href="<?php echo e(route('quote')); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105 shadow-md">
                        Get Quote
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden text-gray-700 hover:text-blue-600">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-4 border-t border-gray-100 mt-2 pt-4">
                <a href="<?php echo e(route('home')); ?>" class="block py-3 text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
                <a href="<?php echo e(route('about')); ?>" class="block py-3 text-gray-700 hover:text-blue-600 font-medium transition">About</a>
                <a href="<?php echo e(route('services')); ?>" class="block py-3 text-gray-700 hover:text-blue-600 font-medium transition">Services</a>
                <a href="<?php echo e(route('process')); ?>" class="block py-3 text-gray-700 hover:text-blue-600 font-medium transition">Process</a>
                <a href="<?php echo e(route('gallery')); ?>" class="block py-3 text-gray-700 hover:text-blue-600 font-medium transition">Gallery</a>
                <a href="<?php echo e(route('blog')); ?>" class="block py-3 text-gray-700 hover:text-blue-600 font-medium transition">Blog</a>
                <a href="<?php echo e(route('contact')); ?>" class="block py-3 text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
                <a href="<?php echo e(route('quote')); ?>" class="block py-3 mt-2 bg-yellow-500 hover:bg-yellow-600 text-white text-center rounded-full font-semibold transition">Get Quote</a>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- About -->
                <div>
                    <h3 class="text-2xl font-bold mb-6">
                        NEW HEROES<span class="text-yellow-500"> INTERNATIONAL LIMITED</span>
                    </h3>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Crafting exceptional logistics experiences through thoughtful planning and 
                        innovative solutions that elevate your business operations.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-400 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-700 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-500 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="<?php echo e(route('about')); ?>" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="<?php echo e(route('services')); ?>" class="text-gray-400 hover:text-white transition">Our Services</a></li>
                        <li><a href="<?php echo e(route('process')); ?>" class="text-gray-400 hover:text-white transition">Our Process</a></li>
                        <li><a href="<?php echo e(route('gallery')); ?>" class="text-gray-400 hover:text-white transition">Gallery</a></li>
                        <li><a href="<?php echo e(route('blog')); ?>" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="<?php echo e(route('login')); ?>" class="text-yellow-400 hover:text-yellow-300 transition font-semibold"><i class="fas fa-lock mr-2"></i>Admin Panel</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Our Services</h3>
                    <ul class="space-y-3">
                        <li class="text-gray-400">Vehicle Clearing</li>
                        <li class="text-gray-400">Heavy Machinery</li>
                        <li class="text-gray-400">Customs Documentation</li>
                        <li class="text-gray-400">Port Cargo Handling</li>
                        <li class="text-gray-400">Logistics Coordination</li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Get In Touch</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-yellow-500"></i>
                            <span class="text-gray-400"><?php echo e($address); ?></span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-yellow-500"></i>
                            <a href="tel:<?php echo e(str_replace(' ', '', $phone1)); ?>" class="text-gray-400 hover:text-white transition"><?php echo e($phone1); ?></a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fab fa-whatsapp text-yellow-500"></i>
                            <a href="https://wa.me/<?php echo e(str_replace([' ', '+', '-'], '', $whatsapp)); ?>" target="_blank" class="text-gray-400 hover:text-white transition"><?php echo e($phone2); ?></a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-yellow-500"></i>
                            <a href="mailto:<?php echo e($email); ?>" class="text-gray-400 hover:text-white transition"><?php echo e($email); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">
                    © <?php echo e(date('Y')); ?> New Heroes International. All rights reserved.
                </p>
                <div class="flex gap-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 bg-blue-900 hover:bg-blue-800 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            const icon = this.querySelector('i');
            if (mobileMenu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        });
        
        // Scroll to top button
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                scrollToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopBtn.classList.remove('opacity-100', 'visible');
                scrollToTopBtn.classList.add('opacity-0', 'invisible');
            }
        });
        
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = mobileMenuBtn.contains(event.target) || mobileMenu.contains(event.target);
            if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/macbook/Documents/Projects/New_heros/resources/views/web/layouts/app.blade.php ENDPATH**/ ?>