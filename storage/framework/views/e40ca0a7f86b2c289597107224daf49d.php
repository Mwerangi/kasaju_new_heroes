<?php $__env->startSection('title', 'Gallery - New Heroes International'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="relative bg-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-6">
                OUR GALLERY
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Photo Gallery
            </h1>
            <p class="text-2xl text-gray-600 leading-relaxed">
                See our professional cargo clearing services in action
            </p>
        </div>
    </div>
</div>

<!-- Category Filter -->
<div class="bg-white border-b border-gray-200 sticky top-0 z-10 shadow-sm">
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-wrap justify-center gap-3">
            <a href="<?php echo e(route('gallery')); ?>" 
                class="px-6 py-3 rounded-full font-semibold transition hover:scale-105 <?php echo e(!request('category') ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                <i class="fas fa-th mr-2"></i>All Photos
            </a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('gallery', ['category' => $category->id])); ?>" 
                    class="px-6 py-3 rounded-full font-semibold transition hover:scale-105 <?php echo e(request('category') == $category->id ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                    <?php echo e($category->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<!-- Gallery Grid -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <?php if($galleries->count() > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-[1600px] mx-auto">
                <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($gallery->image): ?>
                    <div class="group relative overflow-hidden rounded-2xl shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-300 cursor-pointer"
                        onclick="openModal('<?php echo e(asset('storage/' . $gallery->image)); ?>', '<?php echo e(addslashes($gallery->title ?? '')); ?>', '<?php echo e(addslashes($gallery->caption ?? '')); ?>', '<?php echo e(addslashes($gallery->category?->name ?? '')); ?>')">
                        <!-- Image -->
                        <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                            <img src="<?php echo e(asset('storage/' . $gallery->image)); ?>" 
                                alt="<?php echo e($gallery->title); ?>" 
                                loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <!-- Content -->
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <?php if($gallery->title): ?>
                                    <h3 class="font-bold text-lg mb-2 line-clamp-2"><?php echo e($gallery->title); ?></h3>
                                <?php endif; ?>
                                <?php if($gallery->category): ?>
                                    <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold">
                                        <?php echo e($gallery->category->name); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Zoom Icon -->
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white">
                                    <i class="fas fa-search-plus text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                <?php echo e($galleries->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-20 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-images text-gray-400 text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">No Images Available</h3>
                <p class="text-gray-600 mb-8">
                    <?php if(request('category')): ?>
                        No images found in this category.
                    <?php else: ?>
                        Gallery is empty at the moment.
                    <?php endif; ?>
                </p>
                <?php if(request('category')): ?>
                    <a href="<?php echo e(route('gallery')); ?>" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition font-semibold hover:scale-105">
                        <i class="fas fa-th mr-2"></i>View All Images
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeModal()">
    <div class="max-w-7xl w-full" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-6 right-6 w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/20 transition group z-10">
            <i class="fas fa-times text-xl group-hover:rotate-90 transition-transform duration-300"></i>
        </button>

        <!-- Navigation Buttons -->
        <button onclick="navigateImage(-1); event.stopPropagation();" id="prevBtn" class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/20 transition group">
            <i class="fas fa-chevron-left group-hover:-translate-x-1 transition-transform"></i>
        </button>
        <button onclick="navigateImage(1); event.stopPropagation();" id="nextBtn" class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/20 transition group">
            <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
        </button>

        <!-- Image Container -->
        <div class="flex items-center justify-center mb-6">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-[75vh] rounded-2xl shadow-2xl">
        </div>

        <!-- Image Info -->
        <div id="modalInfo" class="text-white text-center max-w-3xl mx-auto">
            <h3 id="modalTitle" class="text-3xl font-bold mb-3"></h3>
            <div id="modalCategory" class="mb-3"></div>
            <p id="modalDescription" class="text-gray-300 text-lg"></p>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <div class="inline-block px-4 py-1.5 bg-white/10 text-white text-sm font-semibold rounded-full mb-6">
                NEED OUR SERVICES?
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Clear Your Cargo?</h2>
            <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                Experience professional clearing and forwarding services for your imports
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo e(route('quote')); ?>" class="px-10 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 hover:scale-105 transition">
                    <i class="fas fa-file-alt mr-2"></i>Request a Quote
                </a>
                <a href="<?php echo e(route('services')); ?>" class="px-10 py-4 bg-white/10 text-white rounded-full font-semibold hover:bg-white/20 hover:scale-105 transition">
                    <i class="fas fa-briefcase mr-2"></i>Our Services
                </a>
                <a href="<?php echo e(route('contact')); ?>" class="px-10 py-4 bg-white/10 text-white rounded-full font-semibold hover:bg-white/20 hover:scale-105 transition">
                    <i class="fas fa-phone mr-2"></i>Contact Us
                </a>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let currentImages = [];
let currentIndex = 0;

// Collect all gallery images on page load
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('[onclick*="openModal"]');
    currentImages = Array.from(galleryItems).map(item => {
        const onclick = item.getAttribute('onclick');
        const match = onclick.match(/openModal\('([^']+)',\s*'([^']*)',\s*'([^']*)',\s*'([^']*)'\)/);
        if (match) {
            return {
                src: match[1],
                title: match[2].replace(/\\'/g, "'"),
                description: match[3].replace(/\\'/g, "'"),
                category: match[4].replace(/\\'/g, "'")
            };
        }
        return null;
    }).filter(item => item !== null);
});

function openModal(imageSrc, title, description, category) {
    const modal = document.getElementById('imageModal');
    
    // Find current image index
    currentIndex = currentImages.findIndex(img => img.src === imageSrc);
    
    updateModalContent(imageSrc, title, description, category);
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    
    // Update navigation buttons visibility
    updateNavigationButtons();
}

function updateModalContent(imageSrc, title, description, category) {
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalCategory = document.getElementById('modalCategory');

    modalImage.src = imageSrc;
    modalTitle.textContent = title || '';
    modalDescription.textContent = description || '';
    
    if (category) {
        modalCategory.innerHTML = `<span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-semibold">${category}</span>`;
    } else {
        modalCategory.innerHTML = '';
    }
}

function navigateImage(direction) {
    if (currentImages.length === 0) return;
    
    currentIndex += direction;
    
    // Loop around
    if (currentIndex < 0) {
        currentIndex = currentImages.length - 1;
    } else if (currentIndex >= currentImages.length) {
        currentIndex = 0;
    }
    
    const image = currentImages[currentIndex];
    updateModalContent(image.src, image.title, image.description, image.category);
    updateNavigationButtons();
}

function updateNavigationButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (currentImages.length <= 1) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'flex';
        nextBtn.style.display = 'flex';
    }
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

// Keyboard navigation
document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('imageModal');
    if (!modal.classList.contains('hidden')) {
        if (event.key === 'Escape') {
            closeModal();
        } else if (event.key === 'ArrowLeft') {
            navigateImage(-1);
        } else if (event.key === 'ArrowRight') {
            navigateImage(1);
        }
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbook/Documents/Projects/New_heros/resources/views/web/gallery.blade.php ENDPATH**/ ?>