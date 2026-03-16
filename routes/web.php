<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Website Routes
Route::get('/', [Web\HomeController::class, 'index'])->name('home');
Route::get('/about', [Web\AboutController::class, 'index'])->name('about');
Route::get('/services', [Web\ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [Web\ServiceController::class, 'show'])->name('services.show');
Route::get('/clearance-process', [Web\ProcessController::class, 'index'])->name('process');
Route::get('/gallery', [Web\GalleryController::class, 'index'])->name('gallery');
Route::get('/testimonials', [Web\TestimonialController::class, 'index'])->name('testimonials');
Route::get('/blog', [Web\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [Web\BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [Web\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [Web\ContactController::class, 'store'])->name('contact.store');
Route::get('/request-quote', [Web\QuoteController::class, 'index'])->name('quote');
Route::post('/request-quote', [Web\QuoteController::class, 'store'])->name('quote.store');
Route::get('/download/{id}', [Web\DownloadController::class, 'download'])->name('download');

// Authentication Routes
Route::get('/login', [Web\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [Web\Auth\LoginController::class, 'login']);
Route::post('/logout', [Web\Auth\LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected by auth middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Page Management
    Route::resource('pages', Admin\PageController::class);
    Route::resource('page-sections', Admin\PageSectionController::class);
    
    // Services Management
    Route::resource('services', Admin\ServiceController::class);
    Route::post('services/reorder', [Admin\ServiceController::class, 'reorder'])->name('services.reorder');
    
    // Process Steps Management
    Route::resource('process-steps', Admin\ProcessStepController::class);
    Route::post('process-steps/reorder', [Admin\ProcessStepController::class, 'reorder'])->name('process-steps.reorder');
    
    // Gallery Management
    Route::resource('gallery-categories', Admin\GalleryCategoryController::class);
    Route::resource('galleries', Admin\GalleryController::class);
    Route::post('galleries/reorder', [Admin\GalleryController::class, 'reorder'])->name('galleries.reorder');
    
    // Testimonials Management
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::post('testimonials/reorder', [Admin\TestimonialController::class, 'reorder'])->name('testimonials.reorder');
    
    // Blog Management
    Route::resource('blog-categories', Admin\BlogCategoryController::class);
    Route::resource('blog-posts', Admin\BlogPostController::class);
    Route::patch('blog-posts/{id}/publish', [Admin\BlogPostController::class, 'publish'])->name('blog-posts.publish');
    Route::patch('blog-posts/{id}/unpublish', [Admin\BlogPostController::class, 'unpublish'])->name('blog-posts.unpublish');
    
    // Inquiries Management
    Route::resource('inquiries', Admin\InquiryController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::post('inquiries/{id}/mark-read', [Admin\InquiryController::class, 'markAsRead'])->name('inquiries.mark-read');
    Route::post('inquiries/{id}/mark-replied', [Admin\InquiryController::class, 'markAsReplied'])->name('inquiries.mark-replied');
    Route::post('inquiries/{id}/assign', [Admin\InquiryController::class, 'assign'])->name('inquiries.assign');
    
    // Contact Information Management
    Route::resource('contact-info', Admin\ContactInformationController::class);
    
    // Downloads Management
    Route::resource('downloads', Admin\DownloadController::class);
    
    // Media Library
    Route::get('media', [Admin\MediaController::class, 'index'])->name('media.index');
    Route::post('media/upload', [Admin\MediaController::class, 'upload'])->name('media.upload');
    Route::delete('media/{id}', [Admin\MediaController::class, 'destroy'])->name('media.destroy');
    
    // SEO Settings
    Route::get('seo-settings', [Admin\SeoSettingController::class, 'index'])->name('seo-settings.index');
    Route::post('seo-settings', [Admin\SeoSettingController::class, 'update'])->name('seo-settings.update');
    
    // Site Settings
    Route::get('site-settings', [Admin\SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('site-settings', [Admin\SiteSettingController::class, 'update'])->name('site-settings.update');
    
    // Users Management (Super Admin only)
    Route::middleware(['role:super-admin'])->group(function () {
        Route::resource('users', Admin\UserController::class);
        Route::post('users/{id}/toggle-status', [Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });
    
    // Activity Logs
    Route::get('activity-logs', [Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
});
