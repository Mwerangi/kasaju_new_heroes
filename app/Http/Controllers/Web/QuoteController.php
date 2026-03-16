<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\User;
use App\Notifications\NewInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class QuoteController extends Controller
{
    public function index()
    {
        return view('web.quote');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cargo_type' => 'nullable|string|max:255',
            'vehicle_type' => 'nullable|string|max:255',
            'port_of_arrival' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('inquiries', 'public');
            $validated['attachment'] = $path;
        }

        $inquiry = Inquiry::create($validated);

        // Send email notification to admin users
        $admins = User::role('super-admin')->where('is_active', true)->get();
        if ($admins->count() > 0) {
            Notification::send($admins, new NewInquiryNotification($inquiry));
        }

        return back()->with('success', 'Your quote request has been submitted successfully. We will contact you shortly!');
    }
}
