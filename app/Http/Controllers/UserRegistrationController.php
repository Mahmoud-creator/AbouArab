<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function create(Request $request)
    {
        $title = "Register Account | AbouArab";
        return view('pages.auth.user.create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|min:5|max:100',
            'password_confirmation' => 'required'
        ]);

        $user = User::create($request->merge(['password' => bcrypt($request->password)])->except('_token'));

        auth()->login($user);

        $request->session()->regenerate();

        return redirect()->intended()->with(['success' => 'Your account has been created successfully!']);
    }
}
