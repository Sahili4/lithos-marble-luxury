<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Add IP address
        $validated['ip_address'] = $request->ip();

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
