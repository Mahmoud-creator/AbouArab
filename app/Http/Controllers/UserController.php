<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Manage Users';
        $users = User::all();
        return view('admin.users', ['title' => $title, 'users' => $users]);
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->delete();
        return response()->json(['message' => 'User was deleted successfully']);
    }

}
