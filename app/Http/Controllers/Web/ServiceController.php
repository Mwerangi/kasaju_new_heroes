<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    public function index()
    {
        // Cache services list for 1 hour
        $services = Cache::remember('services.list', 3600, function () {
            return Service::active()->ordered()->paginate(12);
        });
        
        return view('web.services.index', compact('services'));
    }

    public function show($slug)
    {
        // Cache individual service for 1 hour
        $service = Cache::remember("service.{$slug}", 3600, function () use ($slug) {
            return Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        });
        
        $relatedServices = Cache::remember("service.{$slug}.related", 3600, function () use ($service) {
            return Service::active()
                ->where('id', '!=', $service->id)
                ->ordered()
                ->take(3)
                ->get();
        });
        
        return view('web.services.show', compact('service', 'relatedServices'));
    }
}
