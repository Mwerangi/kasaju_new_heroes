<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    public function index()
    {
        $contacts = ContactInformation::orderBy('group')->orderBy('order')->paginate(50);
        return view('admin.contact-info.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contact-info.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:contact_information,key',
            'label' => 'required|string|max:255',
            'value' => 'required|string',
            'group' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'order' => 'nullable|integer',
        ]);

        // Handle checkbox - if not present, it means unchecked (false)
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $contact = ContactInformation::create($validated);
        
        ActivityLog::log('created', "Created contact info: {$contact->label}", ContactInformation::class, $contact->id);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact information created successfully.');
    }

    public function edit(ContactInformation $contactInfo)
    {
        return view('admin.contact-info.edit', compact('contactInfo'));
    }

    public function update(Request $request, ContactInformation $contactInfo)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:contact_information,key,' . $contactInfo->id,
            'label' => 'required|string|max:255',
            'value' => 'required|string',
            'group' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'order' => 'nullable|integer',
        ]);

        // Handle checkbox - if not present, it means unchecked (false)
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $contactInfo->update($validated);
        
        ActivityLog::log('updated', "Updated contact info: {$contactInfo->label}", ContactInformation::class, $contactInfo->id);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact information updated successfully.');
    }

    public function destroy(ContactInformation $contactInfo)
    {
        $label = $contactInfo->label;
        $contactInfo->delete();
        
        ActivityLog::log('deleted', "Deleted contact info: {$label}", ContactInformation::class, $contactInfo->id);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact information deleted successfully.');
    }
}
