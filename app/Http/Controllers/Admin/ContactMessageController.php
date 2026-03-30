<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index()
    {
        // Get all messages ordered by latest first
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.index', compact('messages'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contact) // Note: parameter name MUST match the resource route singular name 'contact'
    {
        // Mark as read if you have an 'is_read' field in the future.
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'ข้อความติดต่อถูกลบเรียบร้อยแล้ว');
    }
}
