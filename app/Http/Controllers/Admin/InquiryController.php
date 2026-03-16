<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::with('assignedUser')->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->paginate(20);
        $users = User::where('is_active', true)->get();

        // Calculate statistics
        $stats = [
            'total' => Inquiry::count(),
            'new' => Inquiry::where('status', 'new')->count(),
            'read' => Inquiry::where('status', 'read')->count(),
            'replied' => Inquiry::where('status', 'replied')->count(),
            'closed' => Inquiry::where('status', 'closed')->count(),
        ];

        return view('admin.inquiries.index', compact('inquiries', 'users', 'stats'));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load('assignedUser');
        $inquiry->markAsRead();
        
        $users = User::where('is_active', true)->get();

        return view('admin.inquiries.show', compact('inquiry', 'users'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,closed',
            'admin_notes' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $inquiry->update($validated);
        
        ActivityLog::log('updated', "Updated inquiry #{$inquiry->id}", Inquiry::class, $inquiry->id);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Inquiry updated successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $id = $inquiry->id;
        $inquiry->delete();
        
        ActivityLog::log('deleted', "Deleted inquiry #{$id}", Inquiry::class, $id);

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }

    public function markAsRead(Inquiry $inquiry)
    {
        $inquiry->markAsRead();
        return response()->json(['success' => true]);
    }

    public function markAsReplied(Inquiry $inquiry)
    {
        $inquiry->markAsReplied();
        ActivityLog::log('replied', "Marked inquiry #{$inquiry->id} as replied", Inquiry::class, $inquiry->id);
        
        return response()->json(['success' => true]);
    }

    public function assign(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $inquiry->update($validated);
        ActivityLog::log('assigned', "Assigned inquiry #{$inquiry->id} to user", Inquiry::class, $inquiry->id);

        return response()->json(['success' => true]);
    }
}
