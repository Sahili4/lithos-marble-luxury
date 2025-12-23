<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalog;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_catalogs' => Catalog::count(),
            'active_catalogs' => Catalog::active()->count(),
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        $recent_messages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_messages'));
    }
}
