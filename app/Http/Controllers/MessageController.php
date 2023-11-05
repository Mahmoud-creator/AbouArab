<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Message::all();
        $title = "Manage All Messages";
        return view('admin.messages', ['messages' => $messages, 'title' => $title]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Message::create($request->except('_token'));

        return redirect()->back()->with(['success' => 'Your message was sent successfully!']);
    }
}
