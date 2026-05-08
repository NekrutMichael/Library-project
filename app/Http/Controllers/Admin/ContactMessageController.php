<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->get();

        return view('admin.messages.index', compact('messages'));
    }

    // API для React
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        ContactMessage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Повідомлення успішно відправлено'
        ]);
    }
}