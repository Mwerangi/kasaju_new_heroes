<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\Inquiry;
use App\Models\User;
use App\Notifications\NewInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInformation::active()->orderBy('order')->get()->groupBy('group');
        
        return view('web.contact', compact('contactInfo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Save inquiry to database
        $inquiry = Inquiry::create([
            'full_name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'cargo_type' => $validated['subject'] ?? null,
            'message' => $validated['message'],
        ]);

        // Send email notification to admin users
        $admins = User::role('super-admin')->where('is_active', true)->get();
        if ($admins->count() > 0) {
            Notification::send($admins, new NewInquiryNotification($inquiry));
        }
        
        return back()->with('success', 'Thank you for contacting us. We will get back to you soon!');
    }
}
