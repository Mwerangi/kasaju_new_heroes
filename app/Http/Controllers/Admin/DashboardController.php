<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\Gallery;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats for cards
        $stats = [
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
            'total_inquiries' => Inquiry::count(),
            'total_services' => Service::active()->count(),
            'published_posts' => BlogPost::where('is_published', true)->count(),
            'draft_posts' => BlogPost::where('is_published', false)->count(),
            'total_users' => User::where('is_active', true)->count(),
            'gallery_images' => Gallery::where('is_active', true)->count(),
            'testimonials' => \App\Models\Testimonial::where('is_active', true)->count(),
        ];

        // Inquiry status breakdown
        $inquiryStats = [
            'new' => Inquiry::where('status', 'new')->count(),
            'read' => Inquiry::where('status', 'read')->count(),
            'replied' => Inquiry::where('status', 'replied')->count(),
            'closed' => Inquiry::where('status', 'closed')->count(),
        ];

        // Recent inquiries
        $recentInquiries = Inquiry::with('assignedUser')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent blog posts
        $recentPosts = BlogPost::with('author', 'category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent activities
        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Monthly inquiry trend (last 6 months)
        $monthlyInquiries = Inquiry::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact('stats', 'inquiryStats', 'recentInquiries', 'recentPosts', 'recentActivities', 'monthlyInquiries'));
    }
}
