<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Filter by read status
        if ($request->has('filter')) {
            if ($request->filter === 'unread') {
                $query->unread();
            } elseif ($request->filter === 'read') {
                $query->read();
            }
        }

        $messages = $query->latest()->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $message)
    {
        // Mark as read when viewing
        if (!$message->is_read) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Toggle read status of the message.
     */
    public function toggleRead(ContactMessage $message)
    {
        if ($message->is_read) {
            $message->markAsUnread();
        } else {
            $message->markAsRead();
        }

        return back()->with('success', 'Message status updated!');
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully!');
    }
}
